<?php
/**
 * Created by PhpStorm.
 * User: muszkin
 * Date: 07.04.17
 * Time: 15:14
 */

namespace AppBundle\Services\Provider;


use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class CurrentUserProvider
{

    private $tokenStorage;

    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }

    public function getUser()
    {
        if (null === $token = $this->tokenStorage->getToken()){
            return null;
        }
        if (!is_object($user = $token->getUser())) {
            return null;
        }

        return $user;
    }
}