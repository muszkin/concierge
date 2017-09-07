<?php

namespace DashboardBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * NotFoundClients
 *
 * @ORM\Table(name="not_found_clients")
 * @ORM\Entity
 */
class NotFoundClients
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=false)
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="connection_id", type="string", length=32, nullable=false)
     */
    private $connectionId;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=11, nullable=false)
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="login", type="string", length=100, nullable=false)
     */
    private $login;

    /**
     * @var integer
     *
     * @ORM\Column(name="added_phone", type="integer", nullable=false)
     */
    private $addedPhone = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="client_id", type="integer", nullable=true)
     */
    private $clientId;



    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return NotFoundClients
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set connectionId
     *
     * @param string $connectionId
     *
     * @return NotFoundClients
     */
    public function setConnectionId($connectionId)
    {
        $this->connectionId = $connectionId;

        return $this;
    }

    /**
     * Get connectionId
     *
     * @return string
     */
    public function getConnectionId()
    {
        return $this->connectionId;
    }

    /**
     * Set phone
     *
     * @param string $phone
     *
     * @return NotFoundClients
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set login
     *
     * @param string $login
     *
     * @return NotFoundClients
     */
    public function setLogin($login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * Get login
     *
     * @return string
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Set addedPhone
     *
     * @param integer $addedPhone
     *
     * @return NotFoundClients
     */
    public function setAddedPhone($addedPhone)
    {
        $this->addedPhone = $addedPhone;

        return $this;
    }

    /**
     * Get addedPhone
     *
     * @return integer
     */
    public function getAddedPhone()
    {
        return $this->addedPhone;
    }

    /**
     * Set clientId
     *
     * @param integer $clientId
     *
     * @return NotFoundClients
     */
    public function setClientId($clientId)
    {
        $this->clientId = $clientId;

        return $this;
    }

    /**
     * Get clientId
     *
     * @return integer
     */
    public function getClientId()
    {
        return $this->clientId;
    }
}
