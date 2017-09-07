<?php
/**
 * Created by PhpStorm.
 * User: muszkin
 * Date: 05.04.17
 * Time: 14:49
 */

namespace AppBundle\Services\Remote;


use GuzzleHttp\Client;

class DashboardApi
{
    const TODO_LIST_URL = 'https://dashboarddc.com/data/getToDoList/%s/%s';
    const WHMCS_CLIENT_DATA_URL = 'https://dashboarddc.com/data/getWHMCSClientData/%s/full';

    private function get($url)
    {
        $client = new Client();
        $resource = $client->request("GET",$url);

        return json_decode($resource->getBody()->getContents());
    }

    public function getCallList($admin_id,$date)
    {
        $url = sprintf(self::TODO_LIST_URL,$admin_id,$date);

        return $this->get($url);
    }

    public function getClientData($client_id)
    {
        $url = sprintf(self::WHMCS_CLIENT_DATA_URL,$client_id);

        return $this->get($url);
    }
}