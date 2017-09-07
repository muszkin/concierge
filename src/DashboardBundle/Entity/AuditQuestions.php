<?php

namespace DashboardBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AuditQuestions
 *
 * @ORM\Table(name="audit_questions", uniqueConstraints={@ORM\UniqueConstraint(name="id", columns={"question_id"})}, indexes={@ORM\Index(name="team_id", columns={"team_id"})})
 * @ORM\Entity
 */
class AuditQuestions
{
    /**
     * @var integer
     *
     * @ORM\Column(name="question_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $questionId;

    /**
     * @var integer
     *
     * @ORM\Column(name="entry", type="integer", nullable=false)
     */
    private $entry;

    /**
     * @var string
     *
     * @ORM\Column(name="value", type="string", length=100, nullable=false)
     */
    private $value;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=20, nullable=false)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="column_name", type="string", length=20, nullable=true)
     */
    private $columnName;

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
     * Get questionId
     *
     * @return integer
     */
    public function getQuestionId()
    {
        return $this->questionId;
    }

    /**
     * Set entry
     *
     * @param integer $entry
     *
     * @return AuditQuestions
     */
    public function setEntry($entry)
    {
        $this->entry = $entry;

        return $this;
    }

    /**
     * Get entry
     *
     * @return integer
     */
    public function getEntry()
    {
        return $this->entry;
    }

    /**
     * Set value
     *
     * @param string $value
     *
     * @return AuditQuestions
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
     * Set type
     *
     * @param string $type
     *
     * @return AuditQuestions
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set columnName
     *
     * @param string $columnName
     *
     * @return AuditQuestions
     */
    public function setColumnName($columnName)
    {
        $this->columnName = $columnName;

        return $this;
    }

    /**
     * Get columnName
     *
     * @return string
     */
    public function getColumnName()
    {
        return $this->columnName;
    }

    /**
     * Set team
     *
     * @param \DashboardBundle\Entity\Teams $team
     *
     * @return AuditQuestions
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
