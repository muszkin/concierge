<?php

namespace DashboardBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ConciergeAnswerList
 *
 * @ORM\Table(name="concierge_answer_list", uniqueConstraints={@ORM\UniqueConstraint(name="answer_id", columns={"answer_id"})}, indexes={@ORM\Index(name="question_id", columns={"question_id"})})
 * @ORM\Entity
 */
class ConciergeAnswerList
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
     * @ORM\Column(name="value", type="string", length=200, nullable=false)
     */
    private $value;

    /**
     * @var string
     *
     * @ORM\Column(name="ic_tag", type="string", length=100, nullable=false)
     */
    private $icTag;

    /**
     * @var \ConciergeQuestions
     *
     * @ORM\ManyToOne(targetEntity="ConciergeQuestions",cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="question_id", referencedColumnName="question_id")
     * })
     */
    private $question;

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
     * Set value
     *
     * @param string $value
     *
     * @return ConciergeAnswerList
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set icTag
     *
     * @param string $icTag
     *
     * @return ConciergeAnswerList
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

    /**
     * Set question
     *
     * @param \DashboardBundle\Entity\ConciergeQuestions $question
     *
     * @return ConciergeAnswerList
     */
    public function setQuestion(\DashboardBundle\Entity\ConciergeQuestions $question = null)
    {
        $this->question = $question;

        return $this;
    }

    /**
     * Get question
     *
     * @return \DashboardBundle\Entity\ConciergeQuestions
     */
    public function getQuestion()
    {
        return $this->question;
    }

}
