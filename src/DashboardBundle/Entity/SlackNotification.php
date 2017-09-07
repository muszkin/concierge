<?php

namespace DashboardBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SlackNotification
 *
 * @ORM\Table(name="slack_notification")
 * @ORM\Entity
 */
class SlackNotification
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
     * @ORM\Column(name="agent_login", type="string", length=50, nullable=false)
     */
    private $agentLogin;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=10, nullable=false)
     */
    private $type;

    /**
     * @var integer
     *
     * @ORM\Column(name="waiting", type="integer", nullable=true)
     */
    private $waiting;

    /**
     * @var integer
     *
     * @ORM\Column(name="available", type="integer", nullable=false)
     */
    private $available;

    /**
     * @var integer
     *
     * @ORM\Column(name="turn_on", type="integer", nullable=false)
     */
    private $turnOn;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="turn_time", type="datetime", nullable=true)
     */
    private $turnTime;



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
     * @return SlackNotification
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
     * Set agentLogin
     *
     * @param string $agentLogin
     *
     * @return SlackNotification
     */
    public function setAgentLogin($agentLogin)
    {
        $this->agentLogin = $agentLogin;

        return $this;
    }

    /**
     * Get agentLogin
     *
     * @return string
     */
    public function getAgentLogin()
    {
        return $this->agentLogin;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return SlackNotification
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set waiting
     *
     * @param integer $waiting
     *
     * @return SlackNotification
     */
    public function setWaiting($waiting)
    {
        $this->waiting = $waiting;

        return $this;
    }

    /**
     * Get waiting
     *
     * @return integer
     */
    public function getWaiting()
    {
        return $this->waiting;
    }

    /**
     * Set available
     *
     * @param integer $available
     *
     * @return SlackNotification
     */
    public function setAvailable($available)
    {
        $this->available = $available;

        return $this;
    }

    /**
     * Get available
     *
     * @return integer
     */
    public function getAvailable()
    {
        return $this->available;
    }

    /**
     * Set turnOn
     *
     * @param integer $turnOn
     *
     * @return SlackNotification
     */
    public function setTurnOn($turnOn)
    {
        $this->turnOn = $turnOn;

        return $this;
    }

    /**
     * Get turnOn
     *
     * @return integer
     */
    public function getTurnOn()
    {
        return $this->turnOn;
    }

    /**
     * Set turnTime
     *
     * @param \DateTime $turnTime
     *
     * @return SlackNotification
     */
    public function setTurnTime($turnTime)
    {
        $this->turnTime = $turnTime;

        return $this;
    }

    /**
     * Get turnTime
     *
     * @return \DateTime
     */
    public function getTurnTime()
    {
        return $this->turnTime;
    }
}
