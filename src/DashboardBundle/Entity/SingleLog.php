<?php

namespace DashboardBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SingleLog
 *
 * @ORM\Table(name="single_log", indexes={@ORM\Index(name="phone", columns={"phone"})})
 * @ORM\Entity
 */
class SingleLog
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
     * @var string
     *
     * @ORM\Column(name="connection_id", type="string", length=20, nullable=false)
     */
    private $connectionId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=false)
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="login", type="string", length=20, nullable=false)
     */
    private $login;

    /**
     * @var integer
     *
     * @ORM\Column(name="phone", type="integer", nullable=false)
     */
    private $phone;

    /**
     * @var integer
     *
     * @ORM\Column(name="found", type="integer", nullable=false)
     */
    private $found;

    /**
     * @var string
     *
     * @ORM\Column(name="found_data", type="text", length=65535, nullable=true)
     */
    private $foundData;



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
     * Set connectionId
     *
     * @param string $connectionId
     *
     * @return SingleLog
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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return SingleLog
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
     * Set login
     *
     * @param string $login
     *
     * @return SingleLog
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
     * Set phone
     *
     * @param integer $phone
     *
     * @return SingleLog
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return integer
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set found
     *
     * @param integer $found
     *
     * @return SingleLog
     */
    public function setFound($found)
    {
        $this->found = $found;

        return $this;
    }

    /**
     * Get found
     *
     * @return integer
     */
    public function getFound()
    {
        return $this->found;
    }

    /**
     * Set foundData
     *
     * @param string $foundData
     *
     * @return SingleLog
     */
    public function setFoundData($foundData)
    {
        $this->foundData = $foundData;

        return $this;
    }

    /**
     * Get foundData
     *
     * @return string
     */
    public function getFoundData()
    {
        return $this->foundData;
    }
}
