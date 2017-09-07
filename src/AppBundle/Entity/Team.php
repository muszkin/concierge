<?php
/**
 * Created by PhpStorm.
 * User: muszkin
 * Date: 03.04.17
 * Time: 12:12
 */

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Team
 * @package AppBundle\Entity
 * @ORM\Entity
 * @ORM\Table(name="team")
 */
class Team
{

    /**
     * @ORM\Id
     * @ORM\Column(name="team_id",type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="name",type="string",length=255)
     */
    private $name;

    /**
     * @ORM\Column(name="domain",type="string",length=255)
     */
    private $domain;

    /**
     * @ORM\Column(name="no_concierge_lock",type="boolean")
     */
    private $no_concierge_lock;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\User",mappedBy="team")
     */
    private $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * @param mixed $domain
     */
    public function setDomain($domain)
    {
        $this->domain = $domain;
    }

    /**
     * @return mixed
     */
    public function getNoConciergeLock()
    {
        return $this->no_concierge_lock;
    }

    /**
     * @param mixed $no_concierge_lock
     */
    public function setNoConciergeLock($no_concierge_lock)
    {
        $this->no_concierge_lock = $no_concierge_lock;
    }

    /**
     * @return boolean
     */
    public function isNoConciergeLock()
    {
        return $this->no_concierge_lock;
    }
}