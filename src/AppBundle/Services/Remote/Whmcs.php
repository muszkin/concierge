<?php
/**
 * Created by PhpStorm.
 * User: muszkin
 * Date: 06.04.17
 * Time: 11:18
 */

namespace AppBundle\Services\Remote;


use DashboardBundle\Entity\Concierge;
use GuzzleHttp\Client;

class Whmcs implements RemoteInterface
{
    /** @var string $url */
    private $url;

    /** @var string $login */
    private $login;

    /** @var string $password */
    private $password;

    /** @var string $secret */
    private $secret;

    /** @var object $client */
    private $client;

    /** @var object $products */
    private $products;

    /** @var array $licenses */
    private $licenses;

    /** @var  object $order_products */
    private $order_products;

    public function init($config)
    {
        $this->setUrl($config['api_url']);
        $this->setLogin($config['api_login']);
        $this->setPassword($config['api_password']);
        $this->setSecret($config['api_secret']);

        return $this;
    }

    private function doRequest($params = [])
    {
        $whmcs = new Client();
        $request = $whmcs->request("post", $this->url, ["form_params" => $params]);

        return json_decode($request->getBody()->getContents());
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param string $login
     */
    public function setLogin($login)
    {
        $this->login = $login;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = md5($password);
    }

    /**
     * @return string
     */
    public function getSecret()
    {
        return $this->secret;
    }

    /**
     * @param string $secret
     */
    public function setSecret($secret)
    {
        $this->secret = $secret;
    }

    public function findClient($email)
    {
        $params = [
            "action" => "GetClients",
            "username" => $this->getLogin(),
            "password" => $this->getPassword(),
            "search" => $email,
            "responsetype" => "json"
        ];

        $client = $this->doRequest($params);

        if ($client->totalresults > 0) {
            $this->setClient($client->clients->client[0]);
        }

        return $this;
    }

    public function getName()
    {
        if ($this->getClient()) {
            if (empty($this->getClient()->firstname) || empty($this->getClient()->lastname)) {
                if (empty($this->getClient()->companyname)) {
                    return false;
                }
                return $this->getClient()->companyname;
            }
            return trim($this->getClient()->firstname . ' ' . $this->getClient()->lastname);
        }
        return false;
    }

    public function getProductsForClient($id)
    {
        $params = [
            "action" => "GetClientsProducts",
            "username" => $this->getLogin(),
            "password" => $this->getPassword(),
            "clientid" => $id,
            "responsetype" => "json"
        ];

        $client = $this->doRequest($params);

        $this->setProducts($client->products);

        $licenses = [];
        foreach ($this->getProducts() as $products){
            foreach ($products as $product) {
                if (count($product->customfields->customfield) > 0 && $product->customfields->customfield[0]->name == 'Account') {
                    $licenses[] = [
                        "license_id" => $this->parseLicenseNumber($product->customfields->customfield[0]->value),
                        "domain" => $product->domain,
                        "signed_up" => $product->regdate,
                        "status" => $product->status,
                        "crm_license_id" => $product->id,
                        "crm_user_id" => $client->clientid,
                    ];
                }
            }
        }

        $this->setLicenses($licenses);

        return $this;
    }

    public function getProductsFromOrder($order_id)
    {
        $params = [
            "action" => "GetOrders",
            "username" => $this->getLogin(),
            "password" => $this->getPassword(),
            "id" => $order_id,
            "responsetype" => "json"
        ];

        $client = $this->doRequest($params);

        $this->setOrderProducts($client->orders);

        return $this;
    }

    private function parseLicenseNumber($license)
    {
        $int = preg_replace("/([stz](0){0,2})/",'',$license);
        return [
            "original" => $license,
            "int" => $int
        ];
    }

    /**
     * @return object
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param object $client
     */
    public function setClient($client)
    {
        $this->client = $client;
    }

    public function getId()
    {
        return $this->getClient()->id;
    }

    /**
     * @return object
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * @param object $products
     */
    public function setProducts($products)
    {
        $this->products = $products;
    }

    /**
     * @return object
     */
    public function getLicenses()
    {
        return $this->licenses;
    }

    /**
     * @param object $licenses
     */
    public function setLicenses($licenses)
    {
        $this->licenses = $licenses;
    }

    /**
     * @return object
     */
    public function getOrderProducts()
    {
        return $this->order_products;
    }

    /**
     * @param object $order_products
     */
    public function setOrderProducts($order_products)
    {
        $this->order_products = $order_products;
    }

    public function getConciergeData($license_id,$crm_license_id,$crm_client_id,$crm_link,$clientInfo)
    {
        $crm_name = $this->getName();
        $conciergeData = [
            "license_id" => $license_id,
            "domain" => $clientInfo->custom_attributes->license_domain,
            "crm_link" => sprintf($crm_link,$crm_client_id).$crm_license_id,
            "name" => (!$crm_name)?$clientInfo->name:$crm_name,
            "email" => $clientInfo->email,
            "phone" => $clientInfo->phone,
        ];

        return $conciergeData;
    }

    public function getCrmLink($crm_link,$crm_client_id,$crm_license_id)
    {
        return sprintf($crm_link,$crm_client_id).$crm_license_id;
    }

    public function noPhoneSendEmail($crm_client_email,$email_template)
    {
        $this->findClient($crm_client_email);

        $client = $this->getClient();

        $params = [
            "action" => "SendEmail",
            "username" => $this->getLogin(),
            "password" => $this->getPassword(),
            "messagename" => $email_template,
            "id" => $client->id,
            "responsetype" => "json"
        ];

        $client = $this->doRequest($params);

        if ($client->result == 'success'){
            return true;
        }

        return false;

    }

    public function addNoteToClient(Concierge $concierge,$agent)
    {
        $this->findClient($concierge->getEmail());

        $client = $this->getClient();

        $params = [
            "action" => "AddClientNote",
            "username" => $this->getLogin(),
            "password" => $this->getPassword(),
            "userid" => $client->id,
            "notes" => "{$agent} {$concierge->getDomain()}: {$concierge->getNote()}",
        ];

        $client = $this->doRequest($params);

        if ($client->result == 'success'){
            return true;
        }
        return false;
    }
}