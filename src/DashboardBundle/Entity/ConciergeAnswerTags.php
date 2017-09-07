<?php

namespace DashboardBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ConciergeAnswerTags
 *
 * @ORM\Table(name="concierge_answer_tags", uniqueConstraints={@ORM\UniqueConstraint(name="answer_id", columns={"answer_tag_id"})}, indexes={@ORM\Index(name="concierge_id", columns={"concierge_id"}), @ORM\Index(name="tag_id", columns={"tag_id"})})
 * @ORM\Entity
 */
class ConciergeAnswerTags
{
    /**
     * @var integer
     *
     * @ORM\Column(name="answer_tag_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $answerTagId;

    /**
     * @var \Concierge
     *
     * @ORM\ManyToOne(targetEntity="Concierge",cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="concierge_id", referencedColumnName="concierge_id")
     * })
     */
    private $concierge;

    /**
     * @var \ConciergeTagList
     *
     * @ORM\ManyToOne(targetEntity="ConciergeTagList",cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tag_id", referencedColumnName="tag_id")
     * })
     */
    private $tag;



    /**
     * Get answerTagId
     *
     * @return integer
     */
    public function getAnswerTagId()
    {
        return $this->answerTagId;
    }

    /**
     * Set concierge
     *
     * @param \DashboardBundle\Entity\Concierge $concierge
     *
     * @return ConciergeAnswerTags
     */
    public function setConcierge(\DashboardBundle\Entity\Concierge $concierge = null)
    {
        $this->concierge = $concierge;

        return $this;
    }

    /**
     * Get concierge
     *
     * @return \DashboardBundle\Entity\Concierge
     */
    public function getConcierge()
    {
        return $this->concierge;
    }

    /**
     * Set tag
     *
     * @param \DashboardBundle\Entity\ConciergeTagList $tag
     *
     * @return ConciergeAnswerTags
     */
    public function setTag(\DashboardBundle\Entity\ConciergeTagList $tag = null)
    {
        $this->tag = $tag;

        return $this;
    }

    /**
     * Get tag
     *
     * @return \DashboardBundle\Entity\ConciergeTagList
     */
    public function getTag()
    {
        return $this->tag;
    }
}
