<?php

namespace DashboardBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FooterVeryfication
 *
 * @ORM\Table(name="footer_veryfication", uniqueConstraints={@ORM\UniqueConstraint(name="id_2", columns={"id"})}, indexes={@ORM\Index(name="id", columns={"id"}), @ORM\Index(name="provider_id", columns={"provider_id"}), @ORM\Index(name="license_id", columns={"license_id"})})
 * @ORM\Entity
 */
class FooterVeryfication
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
     * @ORM\Column(name="provider_id", type="integer", nullable=false)
     */
    private $providerId;

    /**
     * @var integer
     *
     * @ORM\Column(name="license_id", type="integer", nullable=false)
     */
    private $licenseId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=false)
     */
    private $date;

    /**
     * @var integer
     *
     * @ORM\Column(name="result", type="integer", nullable=false)
     */
    private $result;

    /**
     * @var integer
     *
     * @ORM\Column(name="visible", type="integer", nullable=false)
     */
    private $visible;

    /**
     * @var string
     *
     * @ORM\Column(name="bgcolor", type="string", length=6, nullable=true)
     */
    private $bgcolor;

    /**
     * @var string
     *
     * @ORM\Column(name="linkcolor", type="string", length=6, nullable=true)
     */
    private $linkcolor;

    /**
     * @var integer
     *
     * @ORM\Column(name="linksize", type="integer", nullable=true)
     */
    private $linksize;

    /**
     * @var string
     *
     * @ORM\Column(name="linktext", type="string", length=255, nullable=true)
     */
    private $linktext;

    /**
     * @var string
     *
     * @ORM\Column(name="linkhref", type="string", length=255, nullable=true)
     */
    private $linkhref;

    /**
     * @var float
     *
     * @ORM\Column(name="ratio", type="float", precision=10, scale=0, nullable=true)
     */
    private $ratio;



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
     * Set providerId
     *
     * @param integer $providerId
     *
     * @return FooterVeryfication
     */
    public function setProviderId($providerId)
    {
        $this->providerId = $providerId;

        return $this;
    }

    /**
     * Get providerId
     *
     * @return integer
     */
    public function getProviderId()
    {
        return $this->providerId;
    }

    /**
     * Set licenseId
     *
     * @param integer $licenseId
     *
     * @return FooterVeryfication
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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return FooterVeryfication
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
     * Set result
     *
     * @param integer $result
     *
     * @return FooterVeryfication
     */
    public function setResult($result)
    {
        $this->result = $result;

        return $this;
    }

    /**
     * Get result
     *
     * @return integer
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * Set visible
     *
     * @param integer $visible
     *
     * @return FooterVeryfication
     */
    public function setVisible($visible)
    {
        $this->visible = $visible;

        return $this;
    }

    /**
     * Get visible
     *
     * @return integer
     */
    public function getVisible()
    {
        return $this->visible;
    }

    /**
     * Set bgcolor
     *
     * @param string $bgcolor
     *
     * @return FooterVeryfication
     */
    public function setBgcolor($bgcolor)
    {
        $this->bgcolor = $bgcolor;

        return $this;
    }

    /**
     * Get bgcolor
     *
     * @return string
     */
    public function getBgcolor()
    {
        return $this->bgcolor;
    }

    /**
     * Set linkcolor
     *
     * @param string $linkcolor
     *
     * @return FooterVeryfication
     */
    public function setLinkcolor($linkcolor)
    {
        $this->linkcolor = $linkcolor;

        return $this;
    }

    /**
     * Get linkcolor
     *
     * @return string
     */
    public function getLinkcolor()
    {
        return $this->linkcolor;
    }

    /**
     * Set linksize
     *
     * @param integer $linksize
     *
     * @return FooterVeryfication
     */
    public function setLinksize($linksize)
    {
        $this->linksize = $linksize;

        return $this;
    }

    /**
     * Get linksize
     *
     * @return integer
     */
    public function getLinksize()
    {
        return $this->linksize;
    }

    /**
     * Set linktext
     *
     * @param string $linktext
     *
     * @return FooterVeryfication
     */
    public function setLinktext($linktext)
    {
        $this->linktext = $linktext;

        return $this;
    }

    /**
     * Get linktext
     *
     * @return string
     */
    public function getLinktext()
    {
        return $this->linktext;
    }

    /**
     * Set linkhref
     *
     * @param string $linkhref
     *
     * @return FooterVeryfication
     */
    public function setLinkhref($linkhref)
    {
        $this->linkhref = $linkhref;

        return $this;
    }

    /**
     * Get linkhref
     *
     * @return string
     */
    public function getLinkhref()
    {
        return $this->linkhref;
    }

    /**
     * Set ratio
     *
     * @param float $ratio
     *
     * @return FooterVeryfication
     */
    public function setRatio($ratio)
    {
        $this->ratio = $ratio;

        return $this;
    }

    /**
     * Get ratio
     *
     * @return float
     */
    public function getRatio()
    {
        return $this->ratio;
    }
}
