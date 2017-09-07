<?php
/**
 * Created by PhpStorm.
 * User: muszkin
 * Date: 07.04.17
 * Time: 14:41
 */

namespace AppBundle\Services\Remote;


use DashboardBundle\Entity\Concierge;

class Shoper implements RemoteInterface
{
    const API = "https://admin.shoper.pl/shoper/api/json";

    public function getPromotions()
    {

        $data = array(
            'method' => "getPricesV2",
            'params' => [],
        );

        $ch = curl_init(self::API);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $response = curl_exec($ch);

        if ($response === false) {
            throw new \Exception(curl_error($ch), curl_errno($ch));
        }

        curl_close($ch);

        $result = json_decode($response);

        $jsonData = [
            "price" => [
                "silver" => $result->price->silver,
                "gold" => $result->price->gold,
                "platinum" => $result->price->platinum,
                "diamond" => $result->price->diamond,
            ],
            "promotion" => [
                0 => [
                    "start" => $result->promotion->start.' 00:00:01',
                    "end" => $result->promotion->end.' 23:59:59',
                    "active" => $result->promotion->active,
                    "price" => [
                        "silver" => $result->promotion->price->silver,
                        "gold" => $result->promotion->price->gold,
                        "platinum" => $result->promotion->price->platinum,
                        "diamond" => $result->promotion->price->diamond,
                    ]
                ]
            ],
        ];

        return json_decode(json_encode($jsonData));
    }

    public function addNoteToClient(Concierge $concierge)
    {

    }

    public function init($config)
    {

    }
}