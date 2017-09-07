<?php
namespace AppBundle\EventListener;
use AppBundle\Services\Remote\RemoteInterface;
use DashboardBundle\Entity\Concierge;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\DependencyInjection\Container;

/**
 * Created by PhpStorm.
 * User: muszkin
 * Date: 01.06.17
 * Time: 13:26
 */
class ConciergeNoteListener
{
    /** @var Container $container */
    private $container;

    /** @var array */
    private $teams_config;


    public function __construct(Container $container,$teams)
    {
        $this->container = $container;
        $this->teams_config = $teams;
    }

    public function postPersist(LifecycleEventArgs $args)
    {
        /** @var Concierge $concierge */
        $concierge = $args->getEntity();

        if (!$concierge instanceof Concierge) {
            return;
        }
        $agent = $args->getEntityManager()->getRepository("DashboardBundle:Concierge")->getAgentName($concierge);

        foreach ($this->teams_config as $teamName => $teamConfig) {
            if ($teamName == $concierge->getTeam()->getName()) {
                /** @var RemoteInterface $crm */
                $crm = $this->container->get($teamConfig['api']['api_service']);
                $crm->init($teamConfig['api']);
                $crm->addNoteToClient($concierge,$agent);

                break;
            }
        }
    }
}