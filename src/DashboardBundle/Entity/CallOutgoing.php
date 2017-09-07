<?php

namespace DashboardBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CallOutgoing
 *
 * @ORM\Table(name="call_outgoing", indexes={@ORM\Index(name="connection_id", columns={"connection_id"}), @ORM\Index(name="dst", columns={"dst"}), @ORM\Index(name="id", columns={"id"})})
 * @ORM\Entity
 */
class CallOutgoing
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
     * @ORM\Column(name="src", type="string", length=30, nullable=false)
     */
    private $src;

    /**
     * @var string
     *
     * @ORM\Column(name="dst", type="string", length=30, nullable=false)
     */
    private $dst;

    /**
     * @var string
     *
     * @ORM\Column(name="disposition", type="string", length=20, nullable=false)
     */
    private $disposition;

    /**
     * @var integer
     *
     * @ORM\Column(name="duration", type="integer", nullable=false)
     */
    private $duration;

    /**
     * @var integer
     *
     * @ORM\Column(name="billsec", type="integer", nullable=false)
     */
    private $billsec;

    /**
     * @var string
     *
     * @ORM\Column(name="operator", type="string", length=30, nullable=false)
     */
    private $operator;

    /**
     * @var string
     *
     * @ORM\Column(name="filename", type="string", length=100, nullable=false)
     */
    private $filename;

    /**
     * @var string
     *
     * @ORM\Column(name="user", type="string", length=50, nullable=false)
     */
    private $user;

    /**
     * @var string
     *
     * @ORM\Column(name="connection_id", type="string", length=20, nullable=false)
     */
    private $connectionId;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255, nullable=true)
     */
    private $type;



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
     * @return CallOutgoing
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
     * Set src
     *
     * @param string $src
     *
     * @return CallOutgoing
     */
    public function setSrc($src)
    {
        $this->src = $src;

        return $this;
    }

    /**
     * Get src
     *
     * @return string
     */
    public function getSrc()
    {
        return $this->src;
    }

    /**
     * Set dst
     *
     * @param string $dst
     *
     * @return CallOutgoing
     */
    public function setDst($dst)
    {
        $this->dst = $dst;

        return $this;
    }

    /**
     * Get dst
     *
     * @return string
     */
    public function getDst()
    {
        return $this->dst;
    }

    /**
     * Set disposition
     *
     * @param string $disposition
     *
     * @return CallOutgoing
     */
    public function setDisposition($disposition)
    {
        $this->disposition = $disposition;

        return $this;
    }

    /**
     * Get disposition
     *
     * @return string
     */
    public function getDisposition()
    {
        return $this->disposition;
    }

    /**
     * Set duration
     *
     * @param integer $duration
     *
     * @return CallOutgoing
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
     * @return CallOutgoing
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
     * Set operator
     *
     * @param string $operator
     *
     * @return CallOutgoing
     */
    public function setOperator($operator)
    {
        $this->operator = $operator;

        return $this;
    }

    /**
     * Get operator
     *
     * @return string
     */
    public function getOperator()
    {
        return $this->operator;
    }

    /**
     * Set filename
     *
     * @param string $filename
     *
     * @return CallOutgoing
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
     * Set user
     *
     * @param string $user
     *
     * @return CallOutgoing
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return string
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set connectionId
     *
     * @param string $connectionId
     *
     * @return CallOutgoing
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
     * Set type
     *
     * @param string $type
     *
     * @return CallOutgoing
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
}
