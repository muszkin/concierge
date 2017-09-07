<?php

namespace DashboardBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OldConciergeIn
 *
 * @ORM\Table(name="old_concierge_in")
 * @ORM\Entity
 */
class OldConciergeIn
{
    /**
     * @var integer
     *
     * @ORM\Column(name="concierge_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $conciergeId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=false)
     */
    private $date = 'CURRENT_TIMESTAMP';

    /**
     * @var integer
     *
     * @ORM\Column(name="admin_id", type="integer", nullable=true)
     */
    private $adminId;

    /**
     * @var integer
     *
     * @ORM\Column(name="license_id", type="integer", nullable=true)
     */
    private $licenseId;

    /**
     * @var string
     *
     * @ORM\Column(name="data", type="blob", length=65535, nullable=false)
     */
    private $data;



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
     * @return OldConciergeIn
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
     * Set adminId
     *
     * @param integer $adminId
     *
     * @return OldConciergeIn
     */
    public function setAdminId($adminId)
    {
        $this->adminId = $adminId;

        return $this;
    }

    /**
     * Get adminId
     *
     * @return integer
     */
    public function getAdminId()
    {
        return $this->adminId;
    }

    /**
     * Set licenseId
     *
     * @param integer $licenseId
     *
     * @return OldConciergeIn
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
     * Set data
     *
     * @param string $data
     *
     * @return OldConciergeIn
     */
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Get data
     *
     * @return string
     */
    public function getData()
    {
        return $this->data;
    }
}
