<?php
/**
 * Created by PhpStorm.
 * User: muszkin
 * Date: 12.05.17
 * Time: 11:19
 */

namespace AppBundle\Command;


use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class NoConciergeCommand extends ContainerAwareCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('app:concierge:no:worker')
            ->setDescription("Runs worker for list of no concierge licenses")
            ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $command = $this->getApplication()->find('gearman:worker:execute');
        $arguments = [
            'command' => 'gearman:worker:execute',
            'worker' => 'AppBundleWorkerNoConciergeWorker',
            '-n' => true,
        ];

        $input = new ArrayInput($arguments);

        $command->run($input,$output);
    }
}