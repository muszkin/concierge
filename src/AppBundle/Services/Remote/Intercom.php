<?php
/**
 * Created by PhpStorm.
 * User: muszkin
 * Date: 06.04.17
 * Time: 13:43
 */

namespace AppBundle\Services\Remote;


use AppBundle\Services\Provider\CurrentUserProvider;
use GuzzleHttp\Exception\ClientException;
use Intercom\IntercomClient;
use function property_exists;
use Symfony\Component\DependencyInjection\Container;

class Intercom
{
    private $userProvider;
    private $container;

    /** @var  IntercomClient $client */
    private $client;

    private $segment_id;

    public function __construct(CurrentUserProvider $userProvider,Container $container)
    {
        $this->userProvider = $userProvider;
        $this->container = $container;
    }

    public function init()
    {
        $user = $this->userProvider->getUser();
        $team = $user->getTeam()->getName();
        $token = $this->container->getParameter('app.teams')[$team]['intercom_api_key'];
        $this->segment_id = $this->container->getParameter('app.teams')[$team]['segment_id'];
        $this->client = new IntercomClient($token,null);

        return $this;
    }

    public function initWithTeam($team)
    {
        $token = $this->container->getParameter('app.teams')[$team]['intercom_api_key'];
        $this->segment_id = $this->container->getParameter('app.teams')[$team]['segment_id'];
        $this->client = new IntercomClient($token,null);

        return $this;
    }

    public function getClientInfo($id)
    {
        return $this->client->users->getUser($id);
    }

    public function getUserIdInfo($user_id)
    {
        return $this->client->users->getUsers([
            "user_id" => $user_id
        ]);
    }

    public function getLicenseForClient($user_id)
    {
        $client = $this->client->users->getUsers([
            "user_id" => $user_id
        ]);

        return [
            0 => [
                "license_id" => $user_id,
                "domain" => $client->custom_attributes->license_domain,
                "type" => $client->custom_attributes->license_type,
                "signed_up" => date('Y-m-d',$client->custom_attributes->license_registered_at),
                "status" => ($this->isDomainAvailible("http://".$client->custom_attributes->license_domain))?"Active":"Terminated"
            ]
        ];
    }
    public function isDomainAvailible($domain)
    {
        if(!filter_var($domain, FILTER_VALIDATE_URL))
        {
            return false;
        }

        $curlInit = curl_init($domain);
        curl_setopt($curlInit,CURLOPT_CONNECTTIMEOUT,10);
        curl_setopt($curlInit,CURLOPT_HEADER,true);
        curl_setopt($curlInit,CURLOPT_NOBODY,true);
        curl_setopt($curlInit,CURLOPT_RETURNTRANSFER,true);


        $response = curl_exec($curlInit);

        curl_close($curlInit);

        if ($response) return true;

        return false;
    }

    public function getConciergeData($license_id,$crm_license_id,$crm_client_id,$crm_link,$clientInfo)
    {
        $conciergeData = [
            "license_id" => $license_id,
            "domain" => $clientInfo->custom_attributes->license_domain,
            "crm_link" => sprintf($crm_link,$crm_client_id).$crm_license_id,
            "name" => $clientInfo->name,
            "email" => $clientInfo->email,
            "phone" => $clientInfo->phone,
        ];

        return $conciergeData;
    }

    public function getTodayLicenses()
    {
        $licenses = [];
        try {
            $first = $this->client->users->getUsers([
                "segment_id" => $this->segment_id,
                "per_page" => 60,
            ]);
        }catch (ClientException $clientException){
            $first = $clientException->getResponse()->getBody();
        }
        if (property_exists($first,'pages')) {
            if ($first->pages->total_pages > $first->pages->page) {
                for ($page = $first->pages->page; $page <= $first->pages->total_pages; $page++) {
                    $part = $this->client->users->getUsers([
                        "segment_id" => $this->segment_id,
                        "per_page" => 60,
                        "page" => $page
                    ]);
                    foreach ($part->users as $user) {
                        $licenses['licenses'][] = $user->user_id;
                        $licenses[$user->user_id][] = [
                            "id" => $user->id,
                            "email" => $user->email,
                            "created_at" => date('Y-m-d H:i:s', $user->created_at),
                            "name" => $user->name,
                            "license_id" => $user->user_id,
                            "type" => (property_exists($user->custom_attributes, "license_type")) ? $user->custom_attributes->license_type : "trial"
                        ];
                    }
                }
            } else {
                foreach ($first->users as $user) {
                    $licenses['licenses'][] = $user->user_id;
                    $licenses[$user->user_id][] = [
                        "id" => $user->id,
                        "email" => $user->email,
                        "created_at" => date('Y-m-d H:i:s', $user->created_at),
                        "name" => $user->name,
                        "license_id" => $user->user_id,
                        "type" => $user->custom_attributes->license_type
                    ];
                }
            }

            return $licenses;
        }
        return null;
    }

}