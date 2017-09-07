<?php
/**
 * Created by PhpStorm.
 * User: muszkin
 * Date: 28.04.17
 * Time: 12:05
 */

namespace AppBundle\Services\Local;


use Doctrine\ORM\EntityManagerInterface;
use AppBundle\Entity\ClientStatus as Client;

class ClientStatus
{
    private $em;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
    }

    public function checkClientPhoneEmailStatus($license_id)
    {
        $client = $this->em->getRepository('AppBundle:ClientStatus')->findOneBy([
            "license_id" => $license_id
        ]);

        if ($client){
            return $client->isEmailSended();
        }
        return false;
    }

    public function setClientStatusEmail($license_id,$ic_client_id,$status)
    {
        $client = new Client();
        $client->setLicenseId($license_id);
        $client->setIcClientId($ic_client_id);
        $client->setEmailStatus($status);

        $this->em->persist($client);
        $this->em->flush();

    }
}