<?php
use DashboardBundle\Entity\Concierge;
use Symfony\Component\EventDispatcher\Event;

/**
 * Created by PhpStorm.
 * User: muszkin
 * Date: 01.06.17
 * Time: 13:15
 */
class ConciergeNoteEvent extends Event
{
    const NAME = 'concierge.note';

    protected $concierge;

    public function __construct(Concierge $concierge)
    {
        $this->concierge = $concierge;
    }

    public function getConcierge()
    {
        return $this->concierge;
    }
}