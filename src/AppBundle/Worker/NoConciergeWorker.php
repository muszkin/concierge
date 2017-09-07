<?php
/**
 * Created by PhpStorm.
 * User: muszkin
 * Date: 12.05.17
 * Time: 11:24
 */

namespace AppBundle\Worker;
use AppBundle\Services\Remote\Intercom;
use DashboardBundle\Services\Dashboard;
use Doctrine\ORM\EntityManagerInterface;
use Mmoreram\GearmanBundle\Driver\Gearman;
use Mmoreram\GearmanBundle\Command\Util\GearmanOutputAwareInterface;
use Monolog\Logger;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\Container;
use Doctrine\Common\Cache\Cache;


/**
 * no concierge worker
 *
 * @Gearman\Work(
 *     service="app.no.concierge.worker"
 * )
 */
class NoConciergeWorker implements GearmanOutputAwareInterface
{
    /** @var OutputInterface */
    protected $output;

    /**
     * @var EntityManagerInterface $appEntityManager
     */
    private $appEntityManager;

    /**
     * @var EntityManagerInterface $dashboardEntityManager
     */
    private $dashboardEntityManager;

    /**
     * @var Intercom $intercomApi
     */
    private $intercomApi;

    /**
     * @var Container $container
     */
    private $container;

    /**
     * @var Logger $logger
     */
    private $logger;

    /**
     * @var Cache $cache
     */
    private $cache;

    /**
     * @var Dashboard $dashboard
     */
    private $dashboard;

    public function __construct(
        EntityManagerInterface $appEntityManger,
        EntityManagerInterface $dashboardEntityManager,
        Intercom $intercom,
        Container $container,
        Logger $logger,
        Cache $cache,
        Dashboard $dashboard
    )
    {
        $this->appEntityManager = $appEntityManger;
        $this->dashboardEntityManager = $dashboardEntityManager;
        $this->intercomApi = $intercom;
        $this->container = $container;
        $this->logger = $logger;
        $this->cache = $cache;
        $this->dashboard = $dashboard;
    }

    /**
     * Set the output
     *
     * @param OutputInterface $output
     */
    public function setOutput(OutputInterface $output)
    {
        $this->output = $output;
    }

    /**
     * @param \GearmanJob $job
     * @return bool
     * @Gearman\Job()
     */
    public function process(\GearmanJob $job)
    {
        $this->dashboardEntityManager->clear();
        $this->appEntityManager->clear();

        $jobWorkload = unserialize($job->workload());
        $team = $jobWorkload['team'];
        $this->output->writeln("Got new work ".date('Y-m-d H:i:s'));

        try {
            if(FALSE == $this->appEntityManager->getConnection()->ping()){
                $this->appEntityManager->getConnection()->close();
                $this->appEntityManager->getConnection()->connect();

            }
        } catch (\Throwable $ex) {
            $this->logger->error('Cannot refresh connection app: '.$ex->getMessage());
        }

        try {
            if(FALSE == $this->dashboardEntityManager->getConnection()->ping()){
                $this->dashboardEntityManager->getConnection()->close();
                $this->dashboardEntityManager->getConnection()->connect();

            }
        } catch (\Throwable $ex) {
            $this->logger->error('Cannot refresh connection dashboard : '.$ex->getMessage());
        }

        $teamEntity = $this->appEntityManager->getRepository('AppBundle:Team')->findOneBy([
            "name" => $team
        ]);

        $teamEntity->setNoConciergeLock(true);
        $this->appEntityManager->persist($teamEntity);
        $this->appEntityManager->flush();

        if ($this->cache->contains("{$team}.no.concierge.licenses")){
            $this->cache->delete("{$team}.no.concierge.licenses");
        }
        $intercomAllTrials = $this->intercomApi->initWithTeam($team)->getTodayLicenses();

        $team_crm = $this->dashboardEntityManager->getRepository('DashboardBundle:Teams')->findOneBy([
            "name" => $team,
            "type" => 'staff'
        ]);

        $filtered = $this->dashboard->checkLicenses($intercomAllTrials,$team_crm);


        foreach ($filtered as $key => $license){
            $api_client = $this->container
                ->get($this->container->getParameter('app.teams')[$team]['api']['api_service'])
                ->init($this->container->getParameter('app.teams')[$team]['api'])
                ->findClient($license[0]['email']);

            if ($license[0]['name'] == $license[0]['email']){
                $crm_name = $api_client->getName();
                if ($crm_name){
                    $filtered[$key][0]['name'] = $crm_name;
                }
            }
        }

        $this->cache->save("{$team}.no.concierge.licenses",$filtered);

        $teamEntity->setNoConciergeLock(false);
        $this->appEntityManager->persist($teamEntity);
        $this->appEntityManager->flush();

        $this->appEntityManager->clear();
        $this->dashboardEntityManager->clear();

        $this->output->writeln("Work done.");
        return true;
    }
}