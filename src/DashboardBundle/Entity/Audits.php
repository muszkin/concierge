<?php

namespace DashboardBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Audits
 *
 * @ORM\Table(name="audits", uniqueConstraints={@ORM\UniqueConstraint(name="audit_id", columns={"audit_id"})}, indexes={@ORM\Index(name="team_id", columns={"team_id"})})
 * @ORM\Entity
 */
class Audits
{
    /**
     * @var integer
     *
     * @ORM\Column(name="audit_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $auditId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=false)
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=50, nullable=true)
     */
    private $email;

    /**
     * @var integer
     *
     * @ORM\Column(name="license_id", type="integer", nullable=false)
     */
    private $licenseId;

    /**
     * @var \Teams
     *
     * @ORM\ManyToOne(targetEntity="Teams")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="team_id", referencedColumnName="team_id")
     * })
     */
    private $team;



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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Audits
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
     * Set email
     *
     * @param string $email
     *
     * @return Audits
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
     * Set licenseId
     *
     * @param integer $licenseId
     *
     * @return Audits
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
     * Set team
     *
     * @param \DashboardBundle\Entity\Teams $team
     *
     * @return Audits
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
}
