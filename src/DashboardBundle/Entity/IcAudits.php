<?php

namespace DashboardBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * IcAudits
 *
 * @ORM\Table(name="ic_audits", uniqueConstraints={@ORM\UniqueConstraint(name="id", columns={"id"}), @ORM\UniqueConstraint(name="uniq", columns={"uniq"})}, indexes={@ORM\Index(name="answer_id", columns={"answer_id"})})
 * @ORM\Entity
 */
class IcAudits
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
     * @ORM\Column(name="audit_date", type="datetime", nullable=false)
     */
    private $auditDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="add_date", type="datetime", nullable=false)
     */
    private $addDate;

    /**
     * @var integer
     *
     * @ORM\Column(name="license_id", type="integer", nullable=false)
     */
    private $licenseId;

    /**
     * @var integer
     *
     * @ORM\Column(name="audit_id", type="integer", nullable=false)
     */
    private $auditId;

    /**
     * @var integer
     *
     * @ORM\Column(name="uniq", type="integer", nullable=false)
     */
    private $uniq;

    /**
     * @var \IcAuditsTagmap
     *
     * @ORM\ManyToOne(targetEntity="IcAuditsTagmap")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="answer_id", referencedColumnName="answer_id")
     * })
     */
    private $answer;



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
     * Set auditDate
     *
     * @param \DateTime $auditDate
     *
     * @return IcAudits
     */
    public function setAuditDate($auditDate)
    {
        $this->auditDate = $auditDate;

        return $this;
    }

    /**
     * Get auditDate
     *
     * @return \DateTime
     */
    public function getAuditDate()
    {
        return $this->auditDate;
    }

    /**
     * Set addDate
     *
     * @param \DateTime $addDate
     *
     * @return IcAudits
     */
    public function setAddDate($addDate)
    {
        $this->addDate = $addDate;

        return $this;
    }

    /**
     * Get addDate
     *
     * @return \DateTime
     */
    public function getAddDate()
    {
        return $this->addDate;
    }

    /**
     * Set licenseId
     *
     * @param integer $licenseId
     *
     * @return IcAudits
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
     * Set auditId
     *
     * @param integer $auditId
     *
     * @return IcAudits
     */
    public function setAuditId($auditId)
    {
        $this->auditId = $auditId;

        return $this;
    }

    /**
     * Get auditId
     *
     * @return integer
     */
    public function getAuditId()
    {
        return $this->auditId;
    }

    /**
     * Set uniq
     *
     * @param integer $uniq
     *
     * @return IcAudits
     */
    public function setUniq($uniq)
    {
        $this->uniq = $uniq;

        return $this;
    }

    /**
     * Get uniq
     *
     * @return integer
     */
    public function getUniq()
    {
        return $this->uniq;
    }

    /**
     * Set answer
     *
     * @param \DashboardBundle\Entity\IcAuditsTagmap $answer
     *
     * @return IcAudits
     */
    public function setAnswer(\DashboardBundle\Entity\IcAuditsTagmap $answer = null)
    {
        $this->answer = $answer;

        return $this;
    }

    /**
     * Get answer
     *
     * @return \DashboardBundle\Entity\IcAuditsTagmap
     */
    public function getAnswer()
    {
        return $this->answer;
    }
}
