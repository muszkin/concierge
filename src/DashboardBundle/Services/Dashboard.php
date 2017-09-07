<?php
/**
 * Created by PhpStorm.
 * User: muszkin
 * Date: 07.04.17
 * Time: 10:06
 */

namespace DashboardBundle\Services;


use DashboardBundle\Entity\Teams;
use Doctrine\ORM\EntityManager;

class Dashboard
{
    private $em;

    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    public function checkLicenses(array $licenses,Teams $teams)
    {

        $concierges = $this->em->getRepository('DashboardBundle:Concierge')->findBy([
            "licenseId" => $licenses['licenses'],
            "team" => $teams
        ]);
        $conciergeList = [];
        $list = [];


        foreach ($concierges as $concierge){
            $conciergeList[] = $concierge->getLicenseId();
        }


        foreach ($licenses['licenses'] as $license){
            if (!in_array($license,$conciergeList)){
                $list[] = $licenses[$license];
            }
        }
        $list = $this->array_sort($list,'created_at',SORT_ASC);


        return $list;
    }

    public function array_sort($array, $on, $order=SORT_ASC)
    {
        $new_array = array();
        $sortable_array = array();

        if (count($array) > 0) {
            foreach ($array as $k => $v) {
                if (is_array($v)) {
                    foreach ($v as $k2 => $v2) {
                        if ($k2 == $on) {
                            $sortable_array[$k] = $v2;
                        }
                    }
                } else {
                    $sortable_array[$k] = $v;
                }
            }

            switch ($order) {
                case SORT_ASC:
                    asort($sortable_array);
                    break;
                case SORT_DESC:
                    arsort($sortable_array);
                    break;
            }

            foreach ($sortable_array as $k => $v) {
                $new_array[$k] = $array[$k];
            }
        }

        return $new_array;
    }
}