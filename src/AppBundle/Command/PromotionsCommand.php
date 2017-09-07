<?php

namespace AppBundle\Command;

use Monolog\Logger;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\File;

class PromotionsCommand extends ContainerAwareCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('app:promotions_command')
            ->setDescription('Get current promotions for all teams')
            ->setHelp("This command get promotions for all teams and save them to database")
        ;

    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $promoSetted = false;
        $promotions = $this->getContainer()->get('promotions');
        /** @var Logger $logger */
        $logger = $this->getContainer()->get('logger');

        $fs = new Filesystem();
        if (!$fs->exists("web/public/data")){
            $fs->mkdir("web/public/data");
        }
        foreach ($this->getContainer()->getParameter("app.teams") as $team => $config){
            if (!$fs->exists("web/public/data/".$team.".json")){
                $fs->touch("web/public/data/".$team.".json");
            }
            $today = new \DateTime();
            if ($config['promotions']['url']) {
                $jsonData = $promotions->getPromotions($config['promotions']['url']);
            }else if ($config['promotions']['service']){
                $jsonData = $promotions->getPromotions($this->getContainer()->get($config['promotions']['service']));
            }else{
                $logger->addCritical("Wrong configuration for team $team");
            }
            foreach ($jsonData->promotion as $promotion){
                if ($promotion->active) {
                    $startPromotion = new \DateTime($promotion->start);
                    $endPromotion = new \DateTime($promotion->end);
                    if ($startPromotion <= $today && $today <= $endPromotion){
                        $currentPromo = [
                            "end" => $promotion->end,
                            "price" => [
                                "silver" => $promotion->price->silver,
                                "gold" => $promotion->price->gold,
                                "platinum" => $promotion->price->platinum,
                                "diamond" => $promotion->price->diamond,
                            ],
                            "percentage" => [
                                "silver" => 100 - round((100 * $promotion->price->silver)/$jsonData->price->silver),
                                "gold" => 100 - round((100 * $promotion->price->gold)/$jsonData->price->gold),
                                "platinum" => 100 - round((100 * $promotion->price->platinum)/$jsonData->price->platinum),
                                "diamond" => 100 - round((100 * $promotion->price->diamond)/$jsonData->price->diamond),
                            ],
                        ];
                        $fs->dumpFile("web/public/data/".$team.".json",json_encode($currentPromo));
                        $promoSetted = true;
                        break;
                    }
                }
            }
            if (!$promoSetted){
                foreach ($jsonData->promotion as $promotion){
                    $currentPromo = [
                        "end" => $today->format("Y-m-d H:i:s"),
                        "price" => [
                            "silver" => $jsonData->price->silver,
                            "gold" => $jsonData->price->gold,
                            "platinum" => $jsonData->price->platinum,
                            "diamond" => $jsonData->price->diamond,
                        ],
                        "percentage" => [
                            "silver" => 100,
                            "gold" => 100,
                            "platinum" => 100,
                            "diamond" => 100,
                        ],
                    ];
                    $fs->dumpFile("web/public/data/".$team.".json",json_encode($currentPromo));
                    break;
                }
            }
        }
    }
}
