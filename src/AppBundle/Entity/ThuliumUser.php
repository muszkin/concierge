<?php
/**
 * Created by PhpStorm.
 * User: muszkin
 * Date: 19.05.17
 * Time: 10:01
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class ThuliumUser
 * @package AppBundle\Entity
 * @ORM\Entity
 * @ORM\Table(name="thulium_user")
 */
class ThuliumUser
{

    /**
     * @ORM\Id
     * @ORM\Column(name="thulium_user_id",type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $thulium_user_id;

    /**
     * @ORM\Column(name="login",type="string",length=255)
     */
    private $login;

    /**
     * @ORM\Column(name="sip",type="integer",length=255)
     */
    private $sip;

    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\User",inversedBy="thulium_user",cascade={"persist"})
     * @ORM\JoinColumn(name="user_id",referencedColumnName="user_id")
     */
    private $user;

    /**
     * @return mixed
     */
    public function getThuliumUserId()
    {
        return $this->thulium_user_id;
    }

    /**
     * @return mixed
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param mixed $login
     */
    public function setLogin($login)
    {
        $this->login = $login;
    }

    /**
     * @return mixed
     */
    public function getSip()
    {
        return $this->sip;
    }

    /**
     * @param mixed $sip
     */
    public function setSip($sip)
    {
        $this->sip = $sip;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }
}