<?php

namespace DashboardBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SurveyReply
 *
 * @ORM\Table(name="survey_reply", uniqueConstraints={@ORM\UniqueConstraint(name="hash", columns={"hash"})})
 * @ORM\Entity
 */
class SurveyReply
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
     * @ORM\Column(name="tid", type="integer", nullable=false)
     */
    private $tid;

    /**
     * @var integer
     *
     * @ORM\Column(name="pid", type="integer", nullable=false)
     */
    private $pid;

    /**
     * @var integer
     *
     * @ORM\Column(name="rate", type="integer", nullable=false)
     */
    private $rate;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=64, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="hash", type="string", length=128, nullable=false)
     */
    private $hash;

    /**
     * @var integer
     *
     * @ORM\Column(name="send", type="integer", nullable=false)
     */
    private $send;

    /**
     * @var integer
     *
     * @ORM\Column(name="send_time", type="integer", nullable=false)
     */
    private $sendTime;

    /**
     * @var integer
     *
     * @ORM\Column(name="vote_time", type="integer", nullable=true)
     */
    private $voteTime;

    /**
     * @var integer
     *
     * @ORM\Column(name="resend", type="integer", nullable=false)
     */
    private $resend;

    /**
     * @var integer
     *
     * @ORM\Column(name="resend_time", type="integer", nullable=true)
     */
    private $resendTime;

    /**
     * @var integer
     *
     * @ORM\Column(name="resend_vote", type="integer", nullable=true)
     */
    private $resendVote;

    /**
     * @var integer
     *
     * @ORM\Column(name="voted", type="integer", nullable=false)
     */
    private $voted;

    /**
     * @var integer
     *
     * @ORM\Column(name="open", type="integer", nullable=false)
     */
    private $open;

    /**
     * @var integer
     *
     * @ORM\Column(name="resend_open", type="integer", nullable=true)
     */
    private $resendOpen;

    /**
     * @var string
     *
     * @ORM\Column(name="comment", type="text", length=65535, nullable=true)
     */
    private $comment;

    /**
     * @var integer
     *
     * @ORM\Column(name="resend_rate", type="integer", nullable=true)
     */
    private $resendRate;

    /**
     * @var string
     *
     * @ORM\Column(name="resend_comment", type="text", length=65535, nullable=true)
     */
    private $resendComment;



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
     * @return SurveyReply
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
     * Set tid
     *
     * @param integer $tid
     *
     * @return SurveyReply
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
     * Set pid
     *
     * @param integer $pid
     *
     * @return SurveyReply
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
     * Set rate
     *
     * @param integer $rate
     *
     * @return SurveyReply
     */
    public function setRate($rate)
    {
        $this->rate = $rate;

        return $this;
    }

    /**
     * Get rate
     *
     * @return integer
     */
    public function getRate()
    {
        return $this->rate;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return SurveyReply
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set hash
     *
     * @param string $hash
     *
     * @return SurveyReply
     */
    public function setHash($hash)
    {
        $this->hash = $hash;

        return $this;
    }

    /**
     * Get hash
     *
     * @return string
     */
    public function getHash()
    {
        return $this->hash;
    }

    /**
     * Set send
     *
     * @param integer $send
     *
     * @return SurveyReply
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
     * Set sendTime
     *
     * @param integer $sendTime
     *
     * @return SurveyReply
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

    /**
     * Set voteTime
     *
     * @param integer $voteTime
     *
     * @return SurveyReply
     */
    public function setVoteTime($voteTime)
    {
        $this->voteTime = $voteTime;

        return $this;
    }

    /**
     * Get voteTime
     *
     * @return integer
     */
    public function getVoteTime()
    {
        return $this->voteTime;
    }

    /**
     * Set resend
     *
     * @param integer $resend
     *
     * @return SurveyReply
     */
    public function setResend($resend)
    {
        $this->resend = $resend;

        return $this;
    }

    /**
     * Get resend
     *
     * @return integer
     */
    public function getResend()
    {
        return $this->resend;
    }

    /**
     * Set resendTime
     *
     * @param integer $resendTime
     *
     * @return SurveyReply
     */
    public function setResendTime($resendTime)
    {
        $this->resendTime = $resendTime;

        return $this;
    }

    /**
     * Get resendTime
     *
     * @return integer
     */
    public function getResendTime()
    {
        return $this->resendTime;
    }

    /**
     * Set resendVote
     *
     * @param integer $resendVote
     *
     * @return SurveyReply
     */
    public function setResendVote($resendVote)
    {
        $this->resendVote = $resendVote;

        return $this;
    }

    /**
     * Get resendVote
     *
     * @return integer
     */
    public function getResendVote()
    {
        return $this->resendVote;
    }

    /**
     * Set voted
     *
     * @param integer $voted
     *
     * @return SurveyReply
     */
    public function setVoted($voted)
    {
        $this->voted = $voted;

        return $this;
    }

    /**
     * Get voted
     *
     * @return integer
     */
    public function getVoted()
    {
        return $this->voted;
    }

    /**
     * Set open
     *
     * @param integer $open
     *
     * @return SurveyReply
     */
    public function setOpen($open)
    {
        $this->open = $open;

        return $this;
    }

    /**
     * Get open
     *
     * @return integer
     */
    public function getOpen()
    {
        return $this->open;
    }

    /**
     * Set resendOpen
     *
     * @param integer $resendOpen
     *
     * @return SurveyReply
     */
    public function setResendOpen($resendOpen)
    {
        $this->resendOpen = $resendOpen;

        return $this;
    }

    /**
     * Get resendOpen
     *
     * @return integer
     */
    public function getResendOpen()
    {
        return $this->resendOpen;
    }

    /**
     * Set comment
     *
     * @param string $comment
     *
     * @return SurveyReply
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
     * Set resendRate
     *
     * @param integer $resendRate
     *
     * @return SurveyReply
     */
    public function setResendRate($resendRate)
    {
        $this->resendRate = $resendRate;

        return $this;
    }

    /**
     * Get resendRate
     *
     * @return integer
     */
    public function getResendRate()
    {
        return $this->resendRate;
    }

    /**
     * Set resendComment
     *
     * @param string $resendComment
     *
     * @return SurveyReply
     */
    public function setResendComment($resendComment)
    {
        $this->resendComment = $resendComment;

        return $this;
    }

    /**
     * Get resendComment
     *
     * @return string
     */
    public function getResendComment()
    {
        return $this->resendComment;
    }
}
