<?php
/**
 * Created by PhpStorm.
 * User: muszkin
 * Date: 13.04.17
 * Time: 11:12
 */

namespace AppBundle\Command;


use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Filesystem\Filesystem;

class ExportCommand extends ContainerAwareCommand
{

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('app:export:concierge')
            ->setDescription('Get all concierge data for licenses in file')
            ->setHelp("This command get promotions for all teams and save them to database")
            ->addArgument("team",InputArgument::REQUIRED,'choose one shpr, zctr or zcin')
            ->addArgument("source",InputArgument::REQUIRED,"array or file")
            ->addOption('array','a',InputArgument::IS_ARRAY)
            ->addOption('file','f',InputArgument::OPTIONAL)
            ->addOption('email','em',InputArgument::OPTIONAL)
            ->addUsage("Use this command to export data ,use --f or --a to pass a file(csv) or array with licenses id\n
            Example:\n
            php bin/console app:export:concierge shpr array --a 1,2,3,4,5,6,7,8,9,10 \n
            php bin/console app:export:concierge shpr file --f ids.csv\n")
        ;

    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln([
            "Processing...",
            "=============",
            "",
        ]);

        $source = $input->getArgument('source');

        if (!$input->getOptions($source)) {
            $output->writeln("No $source provided from option --".substr($source,0,1));
        }

        $param = $input->getOptions($source);
        $email = (isset($param['email']))?$param['email']:"wojciech.lisowski@dreamcommerce.com";

        $team = $input->getArgument('team');

        switch ($source){
            case 'array':
                $result = $this->getContainer()->get('app.export.array')->doExport($team,explode(',',$param['array']));
                break;
            case 'file':
                $filename = $param['file'];
                $result = $this->getContainer()->get('app.export.csv')->doExport($team,$filename);
                break;
        }
        $copy = $result;
        $exportFilename = "export.csv";
        $file = fopen($exportFilename,'w');
        fputcsv($file,array_keys(array_shift($copy)),';');
        foreach ($result as $row){
            fputcsv($file,$row,';');
        }
        fclose($file);

        $message = \Swift_Message::newInstance()
            ->setSubject('Export')
            ->setFrom('piotr.mucha@dreamcommerce.com')
            ->setTo($email)
            ->setBody(
                "File in attachment",
                'text/html'
            )
        ;
        $message->attach(\Swift_Attachment::fromPath($exportFilename));

        $this->getContainer()->get('mailer')->send($message);

        $output->writeln("File saved in export.csv");
    }


}