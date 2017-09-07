<?php
/**
 * Created by PhpStorm.
 * User: muszkin
 * Date: 23.05.17
 * Time: 09:23
 */

namespace AppBundle\Services\Remote;


use AppBundle\Entity\User;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use function stream_get_contents;

class Thulium
{
    private $url;

    private $login;

    private $password;

    public function __construct($url,$login,$password)
    {
        $this->url = $url;
        $this->login = $login;
        $this->password = $password;
    }

    public function makeCall($sip,$number)
    {
        $client = new Client();

        $url = "{$this->url}/connections/call";

        try {
            $response = $client->post($url, [
                "json" => [
                    "sip" => $sip,
                    "phone_number" => $number
                ],
                "auth" => [$this->login, $this->password]
            ]);
        }catch (ClientException $exception){
            return json_decode($exception->getResponse()->getBody());
        }

        return json_decode($response->getBody()->getContents());
    }

    public function hangUpCall(User $user)
    {
        $client = new Client();
        $url = "/agents/{$user->getThuliumUser()->getLogin()}/hangup";
        try{
            $response = $client->post($url,[
               "auth" => [$this->login,$this->password]
            ]);
        }catch (ClientException $exception){
            return json_decode($exception->getResponse()->getBody());
        }

        return json_decode($response->getBody()->getContents());
    }
}