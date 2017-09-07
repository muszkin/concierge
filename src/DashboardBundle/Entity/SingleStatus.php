<?php

namespace DashboardBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SingleStatus
 *
 * @ORM\Table(name="single_status")
 * @ORM\Entity
 */
class SingleStatus
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
     * @var string
     *
     * @ORM\Column(name="login", type="string", length=20, nullable=false)
     */
    private $login;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="lastcheck", type="datetime", nullable=false)
     */
    private $lastcheck;



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
     * Set login
     *
     * @param string $login
     *
     * @return SingleStatus
     */
    public function setLogin($login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * Get login
     *
     * @return string
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Set lastcheck
     *
     * @param \DateTime $lastcheck
     *
     * @return SingleStatus
     */
    public function setLastcheck($lastcheck)
    {
        $this->lastcheck = $lastcheck;

        return $this;
    }

    /**
     * Get lastcheck
     *
     * @return \DateTime
     */
    public function getLastcheck()
    {
        return $this->lastcheck;
    }
}
