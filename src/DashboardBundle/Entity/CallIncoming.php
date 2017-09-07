<?php

namespace DashboardBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CallIncoming
 *
 * @ORM\Table(name="call_incoming")
 * @ORM\Entity
 */
class CallIncoming
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
     * @ORM\Column(name="action", type="string", length=20, nullable=false)
     */
    private $action;

    /**
     * @var string
     *
     * @ORM\Column(name="connection_id", type="string", length=20, nullable=false)
     */
    private $connectionId;

    /**
     * @var integer
     *
     * @ORM\Column(name="queue_id", type="integer", nullable=false)
     */
    private $queueId;

    /**
     * @var string
     *
     * @ORM\Column(name="agent_login", type="string", length=50, nullable=true)
     */
    private $agentLogin;

    /**
     * @var string
     *
     * @ORM\Column(name="source_number", type="string", length=30, nullable=false)
     */
    private $sourceNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="destination_number", type="string", length=30, nullable=true)
     */
    private $destinationNumber;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=false)
     */
    private $date;

    /**
     * @var integer
     *
     * @ORM\Column(name="duration", type="integer", nullable=true)
     */
    private $duration;

    /**
     * @var integer
     *
     * @ORM\Column(name="billsec", type="integer", nullable=true)
     */
    private $billsec;

    /**
     * @var string
     *
     * @ORM\Column(name="filename", type="string", length=100, nullable=true)
     */
    private $filename;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="record_id", type="string", length=255, nullable=true)
     */
    private $recordId;

    /**
     * @var integer
     *
     * @ORM\Column(name="phone_number", type="integer", nullable=true)
     */
    private $phoneNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="system_status", type="string", length=255, nullable=true)
     */
    private $systemStatus;

    /**
     * @var integer
     *
     * @ORM\Column(name="status_id", type="integer", nullable=true)
     */
    private $statusId;

    /**
     * @var integer
     *
     * @ORM\Column(name="customer_id", type="integer", nullable=true)
     */
    private $customerId;



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
     * Set action
     *
     * @param string $action
     *
     * @return CallIncoming
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
     * Set connectionId
     *
     * @param string $connectionId
     *
     * @return CallIncoming
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
     * Set queueId
     *
     * @param integer $queueId
     *
     * @return CallIncoming
     */
    public function setQueueId($queueId)
    {
        $this->queueId = $queueId;

        return $this;
    }

    /**
     * Get queueId
     *
     * @return integer
     */
    public function getQueueId()
    {
        return $this->queueId;
    }

    /**
     * Set agentLogin
     *
     * @param string $agentLogin
     *
     * @return CallIncoming
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
     * Set sourceNumber
     *
     * @param string $sourceNumber
     *
     * @return CallIncoming
     */
    public function setSourceNumber($sourceNumber)
    {
        $this->sourceNumber = $sourceNumber;

        return $this;
    }

    /**
     * Get sourceNumber
     *
     * @return string
     */
    public function getSourceNumber()
    {
        return $this->sourceNumber;
    }

    /**
     * Set destinationNumber
     *
     * @param string $destinationNumber
     *
     * @return CallIncoming
     */
    public function setDestinationNumber($destinationNumber)
    {
        $this->destinationNumber = $destinationNumber;

        return $this;
    }

    /**
     * Get destinationNumber
     *
     * @return string
     */
    public function getDestinationNumber()
    {
        return $this->destinationNumber;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return CallIncoming
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
     * Set duration
     *
     * @param integer $duration
     *
     * @return CallIncoming
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * Get duration
     *
     * @return integer
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Set billsec
     *
     * @param integer $billsec
     *
     * @return CallIncoming
     */
    public function setBillsec($billsec)
    {
        $this->billsec = $billsec;

        return $this;
    }

    /**
     * Get billsec
     *
     * @return integer
     */
    public function getBillsec()
    {
        return $this->billsec;
    }

    /**
     * Set filename
     *
     * @param string $filename
     *
     * @return CallIncoming
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;

        return $this;
    }

    /**
     * Get filename
     *
     * @return string
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return CallIncoming
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
     * @param string $recordId
     *
     * @return CallIncoming
     */
    public function setRecordId($recordId)
    {
        $this->recordId = $recordId;

        return $this;
    }

    /**
     * Get recordId
     *
     * @return string
     */
    public function getRecordId()
    {
        return $this->recordId;
    }

    /**
     * Set phoneNumber
     *
     * @param integer $phoneNumber
     *
     * @return CallIncoming
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
     * Set systemStatus
     *
     * @param string $systemStatus
     *
     * @return CallIncoming
     */
    public function setSystemStatus($systemStatus)
    {
        $this->systemStatus = $systemStatus;

        return $this;
    }

    /**
     * Get systemStatus
     *
     * @return string
     */
    public function getSystemStatus()
    {
        return $this->systemStatus;
    }

    /**
     * Set statusId
     *
     * @param integer $statusId
     *
     * @return CallIncoming
     */
    public function setStatusId($statusId)
    {
        $this->statusId = $statusId;

        return $this;
    }

    /**
     * Get statusId
     *
     * @return integer
     */
    public function getStatusId()
    {
        return $this->statusId;
    }

    /**
     * Set customerId
     *
     * @param integer $customerId
     *
     * @return CallIncoming
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
}
