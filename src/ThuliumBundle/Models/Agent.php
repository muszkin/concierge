<?php

use Symfony\Component\Security\Core\User\UserInterface;

class Agent implements AgentInterface
{
    private $agent_id;

    private $login;

    private $name;

    private $surname;

    private $active;

    private $number;

    private $outbound_mode;

    private $user;

    /**
     * @return UserInterface
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param UserInterface $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getOutboundMode()
    {
        return $this->outbound_mode;
    }

    /**
     * @param mixed $outbound_mode
     */
    public function setOutboundMode($outbound_mode)
    {
        $this->outbound_mode = $outbound_mode;
    }

    /**
     * @return mixed
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param mixed $number
     */
    public function setNumber($number)
    {
        $this->number = $number;
    }

    /**
     * @return mixed
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * @param mixed $active
     */
    public function setActive($active)
    {
        $this->active = $active;
    }

    /**
     * @return mixed
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * @param mixed $surname
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;
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
    public function getAgentId()
    {
        return $this->agent_id;
    }

    /**
     * @param mixed $agent_id
     */
    public function setAgentId($agent_id)
    {
        $this->agent_id = $agent_id;
    }
}