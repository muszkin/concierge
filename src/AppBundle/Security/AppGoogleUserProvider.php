<?php
/**
 * Created by PhpStorm.
 * User: muszkin
 * Date: 07.04.17
 * Time: 12:40
 */

namespace AppBundle\Security;


use Doctrine\ORM\EntityManager;
use HWI\Bundle\OAuthBundle\OAuth\Response\UserResponseInterface;
use HWI\Bundle\OAuthBundle\Security\Core\User\OAuthAwareUserProviderInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class AppGoogleUserProvider implements OAuthAwareUserProviderInterface, UserProviderInterface
{
    private $em;

    private $username;

    private $class;

    public function __construct(EntityManager $entityManager,$class)
    {
        $this->em = $entityManager;
        $this->class = $class;
    }

    /**
     * Loads the user for the given username.
     *
     * This method must throw UsernameNotFoundException if the user is not
     * found.
     *
     * @param string $username The username
     *
     * @return UserInterface
     *
     * @throws UsernameNotFoundException if the user is not found
     */
    public function loadUserByUsername($username)
    {
        $user = $this->em->getRepository('AppBundle:User')->findOneBy(["fullname"=>$username]);
        if (!$user){
            throw new UsernameNotFoundException("User not found");
        }

        return $user;
    }

    /**
     * Refreshes the user for the account interface.
     *
     * It is up to the implementation to decide if the user data should be
     * totally reloaded (e.g. from the database), or if the UserInterface
     * object can just be merged into some internal array of users / identity
     * map.
     *
     * @param UserInterface $user
     *
     * @return UserInterface
     *
     * @throws UnsupportedUserException if the account is not supported
     */
    public function refreshUser(UserInterface $user)
    {
        $user = $this->em->getRepository('AppBundle:User')->findOneBy(["fullname" => $user->getUsername()]);

        if (!$user){
            throw new UnsupportedUserException("User no longer exists");
        }

        return $user;
    }

    /**
     * Whether this provider supports the given user class.
     *
     * @param string $class
     *
     * @return bool
     */
    public function supportsClass($class)
    {
        return $class === $this->class || is_subclass_of($class, $this->class);
    }



    /**
     * Loads the user by a given UserResponseInterface object.
     *
     * @param UserResponseInterface $response
     *
     * @return UserInterface
     *
     * @throws UsernameNotFoundException if the user is not found
     */
    public function loadUserByOAuthUserResponse(UserResponseInterface $response)
    {
        $this->username = $response->getUsername();
        $email = $response->getEmail();
        $profile_picture = $response->getProfilePicture();

        $domain = substr($email,(strpos($email,'@')+1));

        $team = $this->em->getRepository("AppBundle:Team")->findOneBy(["domain" => $domain]);

        if (!$team){
            throw new UsernameNotFoundException("You are not a part of company, use your company google account");
        }

        $user = $this->em->getRepository("AppBundle:User")->findOneBy(["email" => $email]);

        if (!$user){
            throw new UsernameNotFoundException("User not found, did you use proper google account?");
        }

        if (!$user->getProfilePicture()){
            $user->setProfilePicture($profile_picture);
            $this->em->persist($user);
            $this->em->flush();
        }

        return $user;
    }
}