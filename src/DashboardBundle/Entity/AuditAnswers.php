<?php

namespace DashboardBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AuditAnswers
 *
 * @ORM\Table(name="audit_answers", indexes={@ORM\Index(name="answer_id", columns={"answer_id"}), @ORM\Index(name="question_id", columns={"question_id"}), @ORM\Index(name="audit_id", columns={"audit_id"})})
 * @ORM\Entity
 */
class AuditAnswers
{
    /**
     * @var integer
     *
     * @ORM\Column(name="audit_answers_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $auditAnswersId;

    /**
     * @var \AuditAnswerList
     *
     * @ORM\ManyToOne(targetEntity="AuditAnswerList")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="answer_id", referencedColumnName="answer_id")
     * })
     */
    private $answer;

    /**
     * @var \AuditQuestions
     *
     * @ORM\ManyToOne(targetEntity="AuditQuestions")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="question_id", referencedColumnName="question_id")
     * })
     */
    private $question;

    /**
     * @var \Audits
     *
     * @ORM\ManyToOne(targetEntity="Audits")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="audit_id", referencedColumnName="audit_id")
     * })
     */
    private $audit;



    /**
     * Get auditAnswersId
     *
     * @return integer
     */
    public function getAuditAnswersId()
    {
        return $this->auditAnswersId;
    }

    /**
     * Set answer
     *
     * @param \DashboardBundle\Entity\AuditAnswerList $answer
     *
     * @return AuditAnswers
     */
    public function setAnswer(\DashboardBundle\Entity\AuditAnswerList $answer = null)
    {
        $this->answer = $answer;

        return $this;
    }

    /**
     * Get answer
     *
     * @return \DashboardBundle\Entity\AuditAnswerList
     */
    public function getAnswer()
    {
        return $this->answer;
    }

    /**
     * Set question
     *
     * @param \DashboardBundle\Entity\AuditQuestions $question
     *
     * @return AuditAnswers
     */
    public function setQuestion(\DashboardBundle\Entity\AuditQuestions $question = null)
    {
        $this->question = $question;

        return $this;
    }

    /**
     * Get question
     *
     * @return \DashboardBundle\Entity\AuditQuestions
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * Set audit
     *
     * @param \DashboardBundle\Entity\Audits $audit
     *
     * @return AuditAnswers
     */
    public function setAudit(\DashboardBundle\Entity\Audits $audit = null)
    {
        $this->audit = $audit;

        return $this;
    }

    /**
     * Get audit
     *
     * @return \DashboardBundle\Entity\Audits
     */
    public function getAudit()
    {
        return $this->audit;
    }
}
