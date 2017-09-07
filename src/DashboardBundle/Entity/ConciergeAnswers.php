<?php

namespace DashboardBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ConciergeAnswers
 *
 * @ORM\Table(name="concierge_answers", indexes={@ORM\Index(name="answer_id", columns={"answer_id"}), @ORM\Index(name="question_id", columns={"question_id"}), @ORM\Index(name="concierge_id", columns={"concierge_id"})})
 * @ORM\Entity
 */
class ConciergeAnswers
{
    /**
     * @var integer
     *
     * @ORM\Column(name="concierge_answers_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $conciergeAnswersId;

    /**
     * @var \ConciergeAnswerList
     *
     * @ORM\ManyToOne(targetEntity="ConciergeAnswerList",cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="answer_id", referencedColumnName="answer_id")
     * })
     */
    private $answer;

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
     * @var \Concierge
     *
     * @ORM\ManyToOne(targetEntity="Concierge",cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="concierge_id", referencedColumnName="concierge_id")
     * })
     */
    private $concierge;



    /**
     * Get conciergeAnswersId
     *
     * @return integer
     */
    public function getConciergeAnswersId()
    {
        return $this->conciergeAnswersId;
    }

    /**
     * Set answer
     *
     * @param \DashboardBundle\Entity\ConciergeAnswerList $answer
     *
     * @return ConciergeAnswers
     */
    public function setAnswer(\DashboardBundle\Entity\ConciergeAnswerList $answer = null)
    {
        $this->answer = $answer;

        return $this;
    }

    /**
     * Get answer
     *
     * @return \DashboardBundle\Entity\ConciergeAnswerList
     */
    public function getAnswer()
    {
        return $this->answer;
    }

    /**
     * Set question
     *
     * @param \DashboardBundle\Entity\ConciergeQuestions $question
     *
     * @return ConciergeAnswers
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

    /**
     * Set concierge
     *
     * @param \DashboardBundle\Entity\Concierge $concierge
     *
     * @return ConciergeAnswers
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

    public function __toString()
    {
        return "concierge_answers";
    }
}
