<?php

namespace DashboardBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ConciergeTagList
 *
 * @ORM\Table(name="concierge_tag_list", uniqueConstraints={@ORM\UniqueConstraint(name="id", columns={"tag_id"})})
 * @ORM\Entity(repositoryClass="ConciergeTagListRepository")
 */
class ConciergeTagList
{
    /**
     * @var integer
     *
     * @ORM\Column(name="tag_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $tagId;

    /**
     * @var string
     *
     * @ORM\Column(name="tag", type="string", length=100, nullable=false)
     */
    private $tag;

    /**
     * @var string
     *
     * @ORM\Column(name="ic_tag", type="string", length=100, nullable=false)
     */
    private $icTag;



    /**
     * Get tagId
     *
     * @return integer
     */
    public function getTagId()
    {
        return $this->tagId;
    }

    /**
     * Set tag
     *
     * @param string $tag
     *
     * @return ConciergeTagList
     */
    public function setTag($tag)
    {
        $this->tag = $tag;

        return $this;
    }

    /**
     * Get tag
     *
     * @return string
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * Set icTag
     *
     * @param string $icTag
     *
     * @return ConciergeTagList
     */
    public function setIcTag($icTag)
    {
        $this->icTag = $icTag;

        return $this;
    }

    /**
     * Get icTag
     *
     * @return string
     */
    public function getIcTag()
    {
        return $this->icTag;
    }
}
