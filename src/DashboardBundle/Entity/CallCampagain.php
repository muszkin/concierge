<?php

namespace DashboardBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CallCampagain
 *
 * @ORM\Table(name="call_campagain")
 * @ORM\Entity
 */
class CallCampagain
{
    /**
     * @var integer
     *
     * @ORM\Column(name="call_campagain_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $callCampagainId;

    /**
     * @var string
     *
     * @ORM\Column(name="action", type="string", length=100, nullable=false)
     */
    private $action;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="record_id", type="integer", nullable=false)
     */
    private $recordId;

    /**
     * @var integer
     *
     * @ORM\Column(name="customer_id", type="integer", nullable=false)
     */
    private $customerId;

    /**
     * @var integer
     *
     * @ORM\Column(name="phone_number", type="integer", nullable=false)
     */
    private $phoneNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="connection_id", type="string", length=100, nullable=false)
     */
    private $connectionId;

    /**
     * @var string
     *
     * @ORM\Column(name="agent_login", type="string", length=100, nullable=false)
     */
    private $agentLogin;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=false)
     */
    private $date;



    /**
     * Get callCampagainId
     *
     * @return integer
     */
    public function getCallCampagainId()
    {
        return $this->callCampagainId;
    }

    /**
     * Set action
     *
     * @param string $action
     *
     * @return CallCampagain
     */
    public function setAction($action)
    {
        $this->action = $action;

        return $this;
    }

    /**
     * Get action
     *
     * @return string
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * Set id
     *
     * @param integer $id
     *
     * @return CallCampagain
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

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
     * Set name
     *
     * @param string $name
     *
     * @return CallCampagain
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set recordId
     *
     * @param integer $recordId
     *
     * @return CallCampagain
     */
    public function setRecordId($recordId)
    {
        $this->recordId = $recordId;

        return $this;
    }

    /**
     * Get recordId
     *
     * @return integer
     */
    public function getRecordId()
    {
        return $this->recordId;
    }

    /**
     * Set customerId
     *
     * @param integer $customerId
     *
     * @return CallCampagain
     */
    public function setCustomerId($customerId)
    {
        $this->customerId = $customerId;

        return $this;
    }

    /**
     * Get customerId
     *
     * @return integer
     */
    public function getCustomerId()
    {
        return $this->customerId;
    }

    /**
     * Set phoneNumber
     *
     * @param integer $phoneNumber
     *
     * @return CallCampagain
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    /**
     * Get phoneNumber
     *
     * @return integer
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * Set connectionId
     *
     * @param string $connectionId
     *
     * @return CallCampagain
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
     * Set agentLogin
     *
     * @param string $agentLogin
     *
     * @return CallCampagain
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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return CallCampagain
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
}
