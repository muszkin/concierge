<?php
/**
 * Created by PhpStorm.
 * User: muszkin
 * Date: 28.04.17
 * Time: 11:59
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * Class ClientStatus
 * @package AppBundle\Entity
 * @ORM\Entity
 * @ORM\Table(name="client_status")
 */
class ClientStatus
{
    /**
     * @ORM\Id
     * @ORM\Column(name="client_status_id",type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $client_status_id;

    /**
     * @ORM\Column(name="ic_client_id",type="string",nullable=true)
     */
    private $ic_client_id;

    /**
     * @ORM\Column(name="license_id",type="integer")
     */
    private $license_id;

    /**
     * @ORM\Column(name="email_status",type="boolean")
     */
    private $email_status;

    /**
     * @return mixed
     */
    public function getClientStatusId()
    {
        return $this->client_status_id;
    }

    /**
     * @return mixed
     */
    public function getIcClientId()
    {
        return $this->ic_client_id;
    }

    /**
     * @param mixed $ic_client_id
     */
    public function setIcClientId($ic_client_id)
    {
        $this->ic_client_id = $ic_client_id;
    }

    /**
     * @return mixed
     */
    public function getLicenseId()
    {
        return $this->license_id;
    }

    /**
     * @param mixed $license_id
     */
    public function setLicenseId($license_id)
    {
        $this->license_id = $license_id;
    }

    /**
     * @return boolean
     */
    public function getEmailStatus()
    {
        return $this->email_status;
    }

    /**
     * @param mixed $email_status
     */
    public function setEmailStatus($email_status)
    {
        $this->email_status = $email_status;
    }

    /**
     * @return boolean
     */
    public function isEmailSended(){
        return $this->email_status;
    }


}