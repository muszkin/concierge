<?php
/**
 * Created by PhpStorm.
 * User: muszkin
 * Date: 06.04.17
 * Time: 12:34
 */

namespace AppBundle\Services;


use GuzzleHttp\Client;

class Promotions
{
    private function get($url)
    {
        $client = new Client();

        $resource = $client->request("GET",$url);

        return json_decode($resource->getBody()->getContents());
    }

    public function getPromotions($param)
    {
        if (is_string($param)){
            return $this->get($param);
        }else if (is_object($param)){
            return $param->getPromotions();
        }else{
            throw new \Exception("Invalid param");
        }
    }
}