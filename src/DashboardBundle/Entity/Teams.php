<?php

namespace DashboardBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Teams
 *
 * @ORM\Table(name="teams", uniqueConstraints={@ORM\UniqueConstraint(name="id", columns={"team_id"})}, indexes={@ORM\Index(name="id_2", columns={"team_id"})})
 * @ORM\Entity
 */
class Teams
{
    /**
     * @var integer
     *
     * @ORM\Column(name="team_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $teamId;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=10, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="ic_key", type="string", length=255, nullable=false)
     */
    private $icKey;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=10, nullable=false)
     */
    private $type;



    /**
     * Get teamId
     *
     * @return integer
     */
    public function getTeamId()
    {
        return $this->teamId;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Teams
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set icKey
     *
     * @param string $icKey
     *
     * @return Teams
     */
    public function setIcKey($icKey)
    {
        $this->icKey = $icKey;

        return $this;
    }

    /**
     * Get icKey
     *
     * @return string
     */
    public function getIcKey()
    {
        return $this->icKey;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return Teams
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
}
