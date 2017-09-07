<?php

namespace DashboardBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tickets
 *
 * @ORM\Table(name="tickets", uniqueConstraints={@ORM\UniqueConstraint(name="id", columns={"id"}), @ORM\UniqueConstraint(name="id_2", columns={"id"})})
 * @ORM\Entity
 */
class Tickets
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
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=false)
     */
    private $date;

    /**
     * @var integer
     *
     * @ORM\Column(name="open_tickets", type="integer", nullable=false)
     */
    private $openTickets;

    /**
     * @var integer
     *
     * @ORM\Column(name="staff_replies", type="integer", nullable=false)
     */
    private $staffReplies;

    /**
     * @var integer
     *
     * @ORM\Column(name="clients_replies", type="integer", nullable=false)
     */
    private $clientsReplies;

    /**
     * @var float
     *
     * @ORM\Column(name="ratio", type="float", precision=10, scale=0, nullable=false)
     */
    private $ratio;



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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Tickets
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set openTickets
     *
     * @param integer $openTickets
     *
     * @return Tickets
     */
    public function setOpenTickets($openTickets)
    {
        $this->openTickets = $openTickets;

        return $this;
    }

    /**
     * Get openTickets
     *
     * @return integer
     */
    public function getOpenTickets()
    {
        return $this->openTickets;
    }

    /**
     * Set staffReplies
     *
     * @param integer $staffReplies
     *
     * @return Tickets
     */
    public function setStaffReplies($staffReplies)
    {
        $this->staffReplies = $staffReplies;

        return $this;
    }

    /**
     * Get staffReplies
     *
     * @return integer
     */
    public function getStaffReplies()
    {
        return $this->staffReplies;
    }

    /**
     * Set clientsReplies
     *
     * @param integer $clientsReplies
     *
     * @return Tickets
     */
    public function setClientsReplies($clientsReplies)
    {
        $this->clientsReplies = $clientsReplies;

        return $this;
    }

    /**
     * Get clientsReplies
     *
     * @return integer
     */
    public function getClientsReplies()
    {
        return $this->clientsReplies;
    }

    /**
     * Set ratio
     *
     * @param float $ratio
     *
     * @return Tickets
     */
    public function setRatio($ratio)
    {
        $this->ratio = $ratio;

        return $this;
    }

    /**
     * Get ratio
     *
     * @return float
     */
    public function getRatio()
    {
        return $this->ratio;
    }
}
