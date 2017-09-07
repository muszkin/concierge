<?php

namespace DashboardBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * ConciergeQuestions
 *
 * @ORM\Table(name="concierge_questions", uniqueConstraints={@ORM\UniqueConstraint(name="id", columns={"question_id"})}, indexes={@ORM\Index(name="team_id", columns={"team_id"})})
 * @ORM\Entity
 */
class ConciergeQuestions
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
     * @var boolean
     *
     * @ORM\Column(name="link", type="boolean", nullable=false)
     */
    private $link = '0';

    /**
     * @ORM\OneToMany(targetEntity="DashboardBundle\Entity\ConciergeAnswerList",mappedBy="question")
     */
    private $answers;

    /**
     * @var \Teams
     *
     * @ORM\ManyToOne(targetEntity="Teams",cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="team_id", referencedColumnName="team_id")
     * })
     */
    private $team;


    public function __construct()
    {
        $this->answers = new ArrayCollection();
    }

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
     * @return ConciergeQuestions
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
     * @return ConciergeQuestions
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
     * @return ConciergeQuestions
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
     * @return ConciergeQuestions
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
     * Set link
     *
     * @param boolean $link
     *
     * @return ConciergeQuestions
     */
    public function setLink($link)
    {
        $this->link = $link;

        return $this;
    }

    /**
     * Get link
     *
     * @return boolean
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Set team
     *
     * @param \DashboardBundle\Entity\Teams $team
     *
     * @return ConciergeQuestions
     */
    public function setTeam(\DashboardBundle\Entity\Teams $team = null)
    {
        $this->team = $team;

        return $this;
    }

    /**
     * Get team
     *
     * @return Teams
     */
    public function getTeam()
    {
        return $this->team;
    }

    public function addAnswer(ConciergeAnswers $answers)
    {
        $this->answers[] = $answers;

        return $this;
    }

    public function removeAnswer(ConciergeAnswers $answers)
    {
        $this->answers->removeElement($answers);

        return $this;
    }

    public function getAnswers()
    {
        return $this->answers;
    }


}
