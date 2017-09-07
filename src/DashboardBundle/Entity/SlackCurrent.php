<?php

namespace DashboardBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SlackCurrent
 *
 * @ORM\Table(name="slack_current")
 * @ORM\Entity
 */
class SlackCurrent
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
     * @var integer
     *
     * @ORM\Column(name="send_date", type="integer", nullable=false)
     */
    private $sendDate;

    /**
     * @var string
     *
     * @ORM\Column(name="channel", type="string", length=10, nullable=false)
     */
    private $channel;

    /**
     * @var integer
     *
     * @ORM\Column(name="waiting", type="integer", nullable=false)
     */
    private $waiting;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=10, nullable=false)
     */
    private $type;

    /**
     * @var integer
     *
     * @ORM\Column(name="send", type="integer", nullable=false)
     */
    private $send;

    /**
     * @var integer
     *
     * @ORM\Column(name="turnon", type="integer", nullable=false)
     */
    private $turnon;

    /**
     * @var integer
     *
     * @ORM\Column(name="turn_date", type="integer", nullable=true)
     */
    private $turnDate;



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
     * Set sendDate
     *
     * @param integer $sendDate
     *
     * @return SlackCurrent
     */
    public function setSendDate($sendDate)
    {
        $this->sendDate = $sendDate;

        return $this;
    }

    /**
     * Get sendDate
     *
     * @return integer
     */
    public function getSendDate()
    {
        return $this->sendDate;
    }

    /**
     * Set channel
     *
     * @param string $channel
     *
     * @return SlackCurrent
     */
    public function setChannel($channel)
    {
        $this->channel = $channel;

        return $this;
    }

    /**
     * Get channel
     *
     * @return string
     */
    public function getChannel()
    {
        return $this->channel;
    }

    /**
     * Set waiting
     *
     * @param integer $waiting
     *
     * @return SlackCurrent
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
     * Set type
     *
     * @param string $type
     *
     * @return SlackCurrent
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
     * Set send
     *
     * @param integer $send
     *
     * @return SlackCurrent
     */
    public function setSend($send)
    {
        $this->send = $send;

        return $this;
    }

    /**
     * Get send
     *
     * @return integer
     */
    public function getSend()
    {
        return $this->send;
    }

    /**
     * Set turnon
     *
     * @param integer $turnon
     *
     * @return SlackCurrent
     */
    public function setTurnon($turnon)
    {
        $this->turnon = $turnon;

        return $this;
    }

    /**
     * Get turnon
     *
     * @return integer
     */
    public function getTurnon()
    {
        return $this->turnon;
    }

    /**
     * Set turnDate
     *
     * @param integer $turnDate
     *
     * @return SlackCurrent
     */
    public function setTurnDate($turnDate)
    {
        $this->turnDate = $turnDate;

        return $this;
    }

    /**
     * Get turnDate
     *
     * @return integer
     */
    public function getTurnDate()
    {
        return $this->turnDate;
    }
}
