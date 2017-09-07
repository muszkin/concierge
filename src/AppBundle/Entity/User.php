<?php
/**
 * Created by PhpStorm.
 * User: muszkin
 * Date: 03.04.17
 * Time: 12:09
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class User
 * @package AppBundle\Entity
 * @ORM\Entity
 * @ORM\Table(name="user")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\Column(name="user_id",type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="fullname",type="string",length=255)
     */
    private $fullname;

    /**
     * @ORM\Column(name="initials",type="string",length=2)
     */
    private $initials;

    /**
     * @ORM\Column(name="email",type="string",length=255)
     */
    private $email;

    /**
     * @ORM\Column(name="admin_id",type="integer")
     */
    private $admin_id;

    /**
     * @ORM\Column(name="profile_picture",type="string",length=255,nullable=true)
     */
    private $profile_picture;

    /**
     * @ORM\Column(name="sip",type="integer",length=4,nullable=true)
     */
    private $sip;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Team",inversedBy="users")
     * @ORM\JoinColumn(referencedColumnName="team_id",onDelete="CASCADE")
     */
    private $team;

    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\ThuliumUser",mappedBy="user")
     */
    private $thulium_user;

    /**
     * @return mixed
     */
    public function getTeam()
    {
        return $this->team;
    }

    /**
     * @param mixed $team
     */
    public function setTeam($team)
    {
        $this->team = $team;
    }

    /**
     * @return mixed
     */
    public function getFullname()
    {
        return $this->fullname;
    }

    /**
     * @param mixed $fullname
     */
    public function setFullname($fullname)
    {
        $this->fullname = $fullname;
    }

    /**
     * @return mixed
     */
    public function getInitials()
    {
        return $this->initials;
    }

    /**
     * @param mixed $initials
     */
    public function setInitials($initials)
    {
        $this->initials = $initials;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }


    /**
     * Returns the roles granted to the user.
     *
     * <code>
     * public function getRoles()
     * {
     *     return array('ROLE_USER');
     * }
     * </code>
     *
     * Alternatively, the roles might be stored on a ``roles`` property,
     * and populated in any number of different ways when the user object
     * is created.
     *
     * @return (Role|string)[] The user roles
     */
    public function getRoles()
    {
        return ["ROLE_ADMIN"];
    }

    /**
     * Returns the password used to authenticate the user.
     *
     * This should be the encoded password. On authentication, a plain-text
     * password will be salted, encoded, and then compared to this value.
     *
     * @return string The password
     */
    public function getPassword()
    {
        return "Authenticate by google";
    }

    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt()
    {
        return null;
    }

    /**
     * Returns the username used to authenticate the user.
     *
     * @return string The username
     */
    public function getUsername()
    {
        return $this->getEmail();
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {
        return;
    }

    /**
     * @return mixed
     */
    public function getAdminId()
    {
        return $this->admin_id;
    }

    /**
     * @param mixed $admin_id
     */
    public function setAdminId($admin_id)
    {
        $this->admin_id = $admin_id;
    }

    /**
     * @return mixed
     */
    public function getProfilePicture()
    {
        return $this->profile_picture;
    }

    /**
     * @param mixed $profile_picture
     */
    public function setProfilePicture($profile_picture)
    {
        $this->profile_picture = $profile_picture;
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
     * @return ThuliumUser
     */
    public function getThuliumUser()
    {
        return $this->thulium_user;
    }

    /**
     * @param ThuliumUser $thulium_user
     */
    public function setThuliumUser($thulium_user)
    {
        $this->thulium_user = $thulium_user;
    }
}