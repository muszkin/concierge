<?php

namespace DashboardBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SurveyResend
 *
 * @ORM\Table(name="survey_resend")
 * @ORM\Entity
 */
class SurveyResend
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
     * @ORM\Column(name="sid", type="integer", nullable=false)
     */
    private $sid;

    /**
     * @var integer
     *
     * @ORM\Column(name="pid", type="integer", nullable=false)
     */
    private $pid;

    /**
     * @var integer
     *
     * @ORM\Column(name="tid", type="integer", nullable=false)
     */
    private $tid;

    /**
     * @var integer
     *
     * @ORM\Column(name="contact", type="integer", nullable=false)
     */
    private $contact;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=false)
     */
    private $date;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="time", type="time", nullable=false)
     */
    private $time;

    /**
     * @var string
     *
     * @ORM\Column(name="link", type="string", length=1024, nullable=false)
     */
    private $link;

    /**
     * @var string
     *
     * @ORM\Column(name="comment", type="text", length=65535, nullable=false)
     */
    private $comment;

    /**
     * @var integer
     *
     * @ORM\Column(name="send_time", type="integer", nullable=false)
     */
    private $sendTime;



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
     * Set sid
     *
     * @param integer $sid
     *
     * @return SurveyResend
     */
    public function setSid($sid)
    {
        $this->sid = $sid;

        return $this;
    }

    /**
     * Get sid
     *
     * @return integer
     */
    public function getSid()
    {
        return $this->sid;
    }

    /**
     * Set pid
     *
     * @param integer $pid
     *
     * @return SurveyResend
     */
    public function setPid($pid)
    {
        $this->pid = $pid;

        return $this;
    }

    /**
     * Get pid
     *
     * @return integer
     */
    public function getPid()
    {
        return $this->pid;
    }

    /**
     * Set tid
     *
     * @param integer $tid
     *
     * @return SurveyResend
     */
    public function setTid($tid)
    {
        $this->tid = $tid;

        return $this;
    }

    /**
     * Get tid
     *
     * @return integer
     */
    public function getTid()
    {
        return $this->tid;
    }

    /**
     * Set contact
     *
     * @param integer $contact
     *
     * @return SurveyResend
     */
    public function setContact($contact)
    {
        $this->contact = $contact;

        return $this;
    }

    /**
     * Get contact
     *
     * @return integer
     */
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return SurveyResend
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
     * Set time
     *
     * @param \DateTime $time
     *
     * @return SurveyResend
     */
    public function setTime($time)
    {
        $this->time = $time;

        return $this;
    }

    /**
     * Get time
     *
     * @return \DateTime
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * Set link
     *
     * @param string $link
     *
     * @return SurveyResend
     */
    public function setLink($link)
    {
        $this->link = $link;

        return $this;
    }

    /**
     * Get link
     *
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Set comment
     *
     * @param string $comment
     *
     * @return SurveyResend
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment
     *
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set sendTime
     *
     * @param integer $sendTime
     *
     * @return SurveyResend
     */
    public function setSendTime($sendTime)
    {
        $this->sendTime = $sendTime;

        return $this;
    }

    /**
     * Get sendTime
     *
     * @return integer
     */
    public function getSendTime()
    {
        return $this->sendTime;
    }
}
