<?php

namespace DashboardBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SurveyNps
 *
 * @ORM\Table(name="survey_nps", uniqueConstraints={@ORM\UniqueConstraint(name="hash", columns={"hash"})})
 * @ORM\Entity
 */
class SurveyNps
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
     * @ORM\Column(name="resend_open", type="integer", nullable=false)
     */
    private $resendOpen;

    /**
     * @var string
     *
     * @ORM\Column(name="comment", type="text", length=65535, nullable=false)
     */
    private $comment;

    /**
     * @var integer
     *
     * @ORM\Column(name="staffrate", type="integer", nullable=false)
     */
    private $staffrate;

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
     * @var integer
     *
     * @ORM\Column(name="resend_staffrate", type="integer", nullable=true)
     */
    private $resendStaffrate;



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
     * @return SurveyNps
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
     * @return SurveyNps
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
     * @return SurveyNps
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
     * Set rate
     *
     * @param integer $rate
     *
     * @return SurveyNps
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
     * @return SurveyNps
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
     * @return SurveyNps
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
     * @return SurveyNps
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
     * @return SurveyNps
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
     * @return SurveyNps
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
     * @return SurveyNps
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
     * @return SurveyNps
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
     * @return SurveyNps
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
     * @return SurveyNps
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
     * @return SurveyNps
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
     * @return SurveyNps
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
     * @return SurveyNps
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
     * Set staffrate
     *
     * @param integer $staffrate
     *
     * @return SurveyNps
     */
    public function setStaffrate($staffrate)
    {
        $this->staffrate = $staffrate;

        return $this;
    }

    /**
     * Get staffrate
     *
     * @return integer
     */
    public function getStaffrate()
    {
        return $this->staffrate;
    }

    /**
     * Set resendRate
     *
     * @param integer $resendRate
     *
     * @return SurveyNps
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
     * @return SurveyNps
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

    /**
     * Set resendStaffrate
     *
     * @param integer $resendStaffrate
     *
     * @return SurveyNps
     */
    public function setResendStaffrate($resendStaffrate)
    {
        $this->resendStaffrate = $resendStaffrate;

        return $this;
    }

    /**
     * Get resendStaffrate
     *
     * @return integer
     */
    public function getResendStaffrate()
    {
        return $this->resendStaffrate;
    }
}
