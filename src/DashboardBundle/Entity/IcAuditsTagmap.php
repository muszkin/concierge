<?php

namespace DashboardBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * IcAuditsTagmap
 *
 * @ORM\Table(name="ic_audits_tagmap", uniqueConstraints={@ORM\UniqueConstraint(name="answer_id", columns={"answer_id"})})
 * @ORM\Entity
 */
class IcAuditsTagmap
{
    /**
     * @var integer
     *
     * @ORM\Column(name="answer_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $answerId;

    /**
     * @var string
     *
     * @ORM\Column(name="ic_tag_name", type="string", length=64, nullable=false)
     */
    private $icTagName;



    /**
     * Get answerId
     *
     * @return integer
     */
    public function getAnswerId()
    {
        return $this->answerId;
    }

    /**
     * Set icTagName
     *
     * @param string $icTagName
     *
     * @return IcAuditsTagmap
     */
    public function setIcTagName($icTagName)
    {
        $this->icTagName = $icTagName;

        return $this;
    }

    /**
     * Get icTagName
     *
     * @return string
     */
    public function getIcTagName()
    {
        return $this->icTagName;
    }
}
