<?php

namespace DashboardBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Concierge
 *
 * @ORM\Table(name="concierge", uniqueConstraints={@ORM\UniqueConstraint(name="concierge_id", columns={"concierge_id"})}, indexes={@ORM\Index(name="team_id", columns={"team_id"})})
 * @ORM\Entity(repositoryClass="ConciergeRepository")
 */
class Concierge
{
    /**
     * @var integer
     *
     * @ORM\Column(name="concierge_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $conciergeId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=false)
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="crm_link", type="string", length=100, nullable=true)
     */
    private $crmLink;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=50, nullable=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100, nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="domain", type="string", length=30, nullable=true)
     */
    private $domain;

    /**
     * @var integer
     *
     * @ORM\Column(name="license_id", type="integer", nullable=false)
     */
    private $licenseId;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=20, nullable=true)
     */
    private $phone;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="next_date", type="date", nullable=true)
     */
    private $nextDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="next_time", type="time", nullable=true)
     */
    private $nextTime;

    /**
     * @var string
     *
     * @ORM\Column(name="note", type="string", length=2000, nullable=true)
     */
    private $note;

    /**
     * @var string
     *
     * @ORM\Column(name="task", type="string", length=1000, nullable=true)
     */
    private $task;

    /**
     * @var integer
     *
     * @ORM\Column(name="order_id", type="integer", nullable=true)
     */
    private $orderId;

    /**
     * @ORM\Column(name="time_matters",type="boolean",nullable=true)
     */
    private $time_matters;

    /**
     * @var \Teams
     *
     * @ORM\ManyToOne(targetEntity="Teams",cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="team_id", referencedColumnName="team_id")
     * })
     */
    private $team;

    /**
     * @ORM\OneToMany(targetEntity="DashboardBundle\Entity\ConciergeAnswers",mappedBy="concierge",cascade={"persist"})
     */
    private $answers;

    /**
     * @ORM\OneToMany(targetEntity="DashboardBundle\Entity\ConciergeAnswerTags",mappedBy="concierge",cascade={"persist"})
     */
    private $tags;


    public function __construct()
    {
        $this->answers = new ArrayCollection();
        $this->tags = new ArrayCollection();
    }

    /**
     * Get conciergeId
     *
     * @return integer
     */
    public function getConciergeId()
    {
        return $this->conciergeId;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Concierge
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
     * Set crmLink
     *
     * @param string $crmLink
     *
     * @return Concierge
     */
    public function setCrmLink($crmLink)
    {
        $this->crmLink = $crmLink;

        return $this;
    }

    /**
     * Get crmLink
     *
     * @return string
     */
    public function getCrmLink()
    {
        return $this->crmLink;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Concierge
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
     * Set name
     *
     * @param string $name
     *
     * @return Concierge
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
     * Set domain
     *
     * @param string $domain
     *
     * @return Concierge
     */
    public function setDomain($domain)
    {
        $this->domain = $domain;

        return $this;
    }

    /**
     * Get domain
     *
     * @return string
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * Set licenseId
     *
     * @param integer $licenseId
     *
     * @return Concierge
     */
    public function setLicenseId($licenseId)
    {
        $this->licenseId = $licenseId;

        return $this;
    }

    /**
     * Get licenseId
     *
     * @return integer
     */
    public function getLicenseId()
    {
        return $this->licenseId;
    }

    /**
     * Set phone
     *
     * @param string $phone
     *
     * @return Concierge
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
     * Set nextDate
     *
     * @param \DateTime $nextDate
     *
     * @return Concierge
     */
    public function setNextDate($nextDate)
    {
        $this->nextDate = $nextDate;

        return $this;
    }

    /**
     * Get nextDate
     *
     * @return \DateTime
     */
    public function getNextDate()
    {
        return $this->nextDate;
    }

    /**
     * Set nextTime
     *
     * @param \DateTime $nextTime
     *
     * @return Concierge
     */
    public function setNextTime($nextTime)
    {
        $this->nextTime = $nextTime;

        return $this;
    }

    /**
     * Get nextTime
     *
     * @return \DateTime
     */
    public function getNextTime()
    {
        return $this->nextTime;
    }

    /**
     * Set note
     *
     * @param string $note
     *
     * @return Concierge
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get note
     *
     * @return string
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Set task
     *
     * @param string $task
     *
     * @return Concierge
     */
    public function setTask($task)
    {
        $this->task = $task;

        return $this;
    }

    /**
     * Get task
     *
     * @return string
     */
    public function getTask()
    {
        return $this->task;
    }

    /**
     * Set orderId
     *
     * @param integer $orderId
     *
     * @return Concierge
     */
    public function setOrderId($orderId)
    {
        $this->orderId = $orderId;

        return $this;
    }

    /**
     * Get orderId
     *
     * @return integer
     */
    public function getOrderId()
    {
        return $this->orderId;
    }

    /**
     * Set team
     *
     * @param \DashboardBundle\Entity\Teams $team
     *
     * @return Concierge
     */
    public function setTeam(\DashboardBundle\Entity\Teams $team = null)
    {
        $this->team = $team;

        return $this;
    }

    /**
     * Get team
     *
     * @return \DashboardBundle\Entity\Teams
     */
    public function getTeam()
    {
        return $this->team;
    }

    public function addAnswer(ConciergeAnswers $answers)
    {
        $this->answers[] = $answers;

        return $this;
    }

    public function removeAnswer(ConciergeAnswers $answers)
    {
        $this->answers->removeElement($answers);

        return $this;
    }

    public function getAnswers()
    {
        return $this->answers;
    }

    public function addTag(ConciergeAnswerTags $answerTags)
    {
        $this->tags[] = $answerTags;

        return $this;
    }

    public function removeTag(ConciergeAnswerTags $answerTags)
    {
        $this->tags->removeElement($answerTags);

        return $this;
    }

    public function getTags()
    {
        return $this->tags;
    }

    public function toArray()
    {
        return [
            "concierge_id" => $this->conciergeId,
            "date" => ($this->date)?$this->date->format('Y-m-d H:i:s'):null,
            "crm_link" => $this->crmLink,
            "email" => $this->email,
            "name" => $this->name,
            "domain" => $this->domain,
            "license_id" => $this->licenseId,
            "phone" => $this->phone,
            "next_date" => ($this->nextDate)?$this->nextDate->format('Y-m-d'):null,
            "next_time" => ($this->nextTime)?$this->nextTime->format('H:i:s'):null,
            "note" => $this->note,
            "task" => $this->task,
            "order_id" => $this->orderId,
        ];
    }

    /**
     * @return mixed
     */
    public function getTimeMatters()
    {
        return $this->time_matters;
    }

    /**
     * @param mixed $time_matters
     */
    public function setTimeMatters($time_matters)
    {
        $this->time_matters = $time_matters;
    }
}
