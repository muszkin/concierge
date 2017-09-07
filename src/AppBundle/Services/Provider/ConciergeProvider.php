<?php
/**
 * Created by PhpStorm.
 * User: muszkin
 * Date: 12.04.17
 * Time: 10:08
 */

namespace AppBundle\Services\Provider;


use DashboardBundle\Entity\Concierge;
use DashboardBundle\Entity\ConciergeAnswers;
use DashboardBundle\Entity\ConciergeAnswerTags;
use DashboardBundle\Entity\ConciergeQuestions;
use DashboardBundle\Entity\Teams;
use Doctrine\Common\Cache\Cache;
use Doctrine\ORM\EntityManager;

class ConciergeProvider implements ConciergeProviderInterface
{

    const FIELDS = [
        "Persona" => "persona",
        "How many products will be at the beginning in shop" => "amount_of_goods",
        "When online selling should start" => "when_to_start",
        "Branch" => "industry",
        "How many hours, daily, can you be engaged in web-shop" => "how_much_time_spend",
        "Reasons to await for beginning online store (client-end)" => "what_to_wait"
    ];

    private $em;

    private $cache;

    public function __construct(EntityManager $entityManager,Cache $cache)
    {
        $this->em = $entityManager;
        $this->cache = $cache;
    }

    public function getFullfilledLastConcierge($license_id,$team)
    {
        $lastFullfilledConcierge = $this->em->getRepository('DashboardBundle:Concierge')->getConciergeFullData($license_id,$team,self::FIELDS);

        return $lastFullfilledConcierge;
    }

    public function getConciergeNotes($license_id,$team)
    {
        $notes = $this->em->getRepository('DashboardBundle:Concierge')->getConciergeNotes($license_id,$team);

        return $notes;
    }

    public function getAllProspectAndLevel($license_id,$team)
    {
        $result = $this->em->getRepository('DashboardBundle:Concierge')->getAllProspectAndLevel($license_id,$team);
        foreach ($result as $key => $status){
            if (empty($status['status'])){
                unset($result[$key]);
            }
        }
        return $result;
    }


    public function exportAllData($team, $licenses)
    {
        $exampleArray = $this->createFullArray($team);

        $result = $this->em->getRepository('DashboardBundle:Concierge')->exportAll($team,$licenses,$exampleArray);

        return $result;
    }

    public function createFullArray($team)
    {
        $team = $this->em->getRepository("DashboardBundle:Teams")->findOneBy([
            "name" => $team,
        ]);

        $concierge = $this->em->getRepository("DashboardBundle:Concierge")->findOneBy([
            "team" => $team
        ]);
        $return = [];
        $return['concierge_id'] = null;
        foreach ($concierge as $key => $value){
            $return[$key] = null;
        }

        $conciergeQuestions = $this->em->getRepository("DashboardBundle:ConciergeQuestions")->findBy([
            "team" => $team
        ]);

        foreach ($conciergeQuestions as $question){
            /** @var ConciergeQuestions $question */
            if ($question->getColumnName()){
                $return[$question->getColumnName()] = null;
            }else {
                $return[$question->getValue()] = null;
            }
        }

        $return['tags'] = null;

        return $return;
    }

    public function getClientLicensesByEmail($email)
    {
        $licenses = $this->em->getRepository('DashboardBundle:Concierge')->findBy([
            "email" => $email,
        ]);

        $ids = [];
        if (count($licenses) > 0){
            foreach ($licenses as $license){
                /** @var Concierge $license */
                $link = $license->getCrmLink();
                $params = parse_url($link);
                parse_str($params['query'],$query);
                $ids[$license->getLicenseId()]['whmcs_user_id'] = $query['userid'];
                $ids[$license->getLicenseId()]['whmcs_license_id'] = $query['id'];
                $ids[$license->getLicenseId()]['true_license_id'] = $license->getLicenseId();
            }
            return $ids;
        }

        return null;
    }

    /**
     * @param $payload
     * @return Concierge
     */
    public function parseConciergeFormData($payload,$username,$team)
    {
        $concierge = new Concierge();
        foreach ($payload as $key => $value){
            if (is_string($key) && !is_array($value)){
                $question = $this->em->getRepository('DashboardBundle:ConciergeQuestions')->findOneBy([
                    "columnName" => $key,
                    "type" => "open"
                ]);
                if ($question){
                    call_user_func([$concierge,$this->parseKeyToSetFunction($key)],$value);
                }
            }else if (is_int($key) && !is_array($value)){
                $question = $this->em->getRepository('DashboardBundle:ConciergeQuestions')->findOneBy([
                    "questionId" => $key,
                    "type" => "single"
                ]);
                if ($question){
                    $answer = $this->em->getRepository('DashboardBundle:ConciergeAnswerList')->findOneBy([
                        "answerId" => $value,
                        "question" => $question
                    ]);
                    if ($answer){
                        $conciergeAnswer = new ConciergeAnswers();
                        $conciergeAnswer->setAnswer($answer);
                        $conciergeAnswer->setQuestion($question);
                        $conciergeAnswer->setConcierge($concierge);
                        $concierge->addAnswer($conciergeAnswer);
                    }
                }
            }else if (is_array($value)){
                $question = $this->em->getRepository('DashboardBundle:ConciergeQuestions')->findOneBy([
                    "questionId" => $key,
                    "type" => "multi"
                ]);
                if ($question){
                    foreach ($value as $k => $tag_id){
                        $tag = $this->em->getRepository('DashboardBundle:ConciergeTagList')->findOneBy([
                            "tagId" => $tag_id
                        ]);
                        if ($tag){
                            $conciergeAnswerTag = new ConciergeAnswerTags();
                            $conciergeAnswerTag->setTag($tag);
                            $conciergeAnswerTag->setConcierge($concierge);
                            $concierge->addTag($conciergeAnswerTag);
                        }
                    }
                }
            }
        }
        $concierge->setTeam($team);

        $concierge = $this->addAgentToConcierge($concierge,$username);

        return $concierge;
    }

    public function parseKeyToSetFunction($key)
    {
        $words = explode('_',$key);
        foreach ($words as $k => $word){
            $words[$k] = ucfirst($word);
        }
        $function = implode('',$words);
        return 'set'.$function;
    }

    public function getLastConciergeData($team_crm,$license_id)
    {
        return $this->em->getRepository('DashboardBundle:Concierge')->findOneBy([
            "team" => $team_crm,
            "licenseId" => $license_id
        ],[
            "conciergeId" => "DESC"
        ]);
    }

    public function fillPostponedConcierge($license_id,$crm_team,$clientInfo,$nextDate,$nextTime,$note,$username,$crm_link)
    {
        $lastConcierge = $this->em->getRepository('DashboardBundle:Concierge')->findOneBy([
            "team" => $crm_team,
            "licenseId" => $license_id
        ],[
            "conciergeId" => "DESC"
        ]);
        $concierge = $this->fillBasicConcierge($license_id,$crm_team,$clientInfo,$username,$crm_link);

        if ($lastConcierge){
            $concierge->setName($lastConcierge->getName());
            $concierge->setDomain($lastConcierge->getDomain());
            $concierge->setCrmLink((is_null($lastConcierge->getCrmLink()))?$crm_link:$lastConcierge->getCrmLink());
            $concierge->setPhone($lastConcierge->getPhone());
            $concierge->setTeam($lastConcierge->getTeam());
            $concierge->setLicenseId($lastConcierge->getLicenseId());
            $concierge->setNote("Postponed until: ".$nextDate->format('Y-m-d')." ".$nextTime->format('H:i:s').PHP_EOL.$note);
            $concierge->setNextDate($nextDate);
            $concierge->setNextTime($nextTime);
            $concierge->setEmail((is_null($lastConcierge->getEmail()))?$clientInfo->email:$lastConcierge->getEmail());
        }else{
            $concierge->setNote("Postponed until: ".$nextDate->format('Y-m-d')." ".$nextTime->format('H:i:s').PHP_EOL.$note);
            $concierge->setNextDate($nextDate);
            $concierge->setNextTime($nextTime);
        }

        return $concierge;
    }

    public function fillNotRelatedConcierge($license_id,$crm_team,$clientInfo,$note,$username,$crm_link)
    {
        $concierge = $this->fillBasicConcierge($license_id,$crm_team,$clientInfo,$username,$crm_link);

        $concierge->setNote("Client not related\n$note");

        return $concierge;
    }

    /**
     * @param $license_id
     * @param $crm_team
     * @param $clientInfo
     * @param $username
     * @return Concierge
     */
    public function fillBasicConcierge($license_id,$crm_team,$clientInfo,$username,$crm_link)
    {
        $date = new \DateTime();
        $concierge = new Concierge();
        $concierge->setName($clientInfo->name);
        $concierge->setDate($date);
        $concierge->setDomain($clientInfo->custom_attributes->license_domain);
        $concierge->setPhone($clientInfo->phone);
        $concierge->setTeam($crm_team);
        $concierge->setLicenseId($license_id);
        $concierge->setEmail($clientInfo->email);
        $concierge->setCrmLink($crm_link);

        $answer = $this->em->getRepository('DashboardBundle:ConciergeAnswerList')->findOneBy([
            "value" => $username
        ]);
        if ($answer){
            $question = $answer->getQuestion();
            $conciergeAnswer = new ConciergeAnswers();
            $conciergeAnswer->setQuestion($question);
            $conciergeAnswer->setAnswer($answer);
            $conciergeAnswer->setConcierge($concierge);
            $concierge->addAnswer($conciergeAnswer);
        }

        return $concierge;
    }

    public function fillNotAnsweredConcierge($license_id,$crm_team,$clientInfo,\DateTime $nextDate,\DateTime $nextTime,$username,$crm_link)
    {
        $concierge = $this->fillBasicConcierge($license_id,$crm_team,$clientInfo,$username,$crm_link);

        $concierge->setNextDate($nextDate);
        $concierge->setNextTime($nextTime);
        $concierge->setNote("Client not answered, next contact: ".$nextDate->format('Y-m-d')." ".$nextTime->format('H:i:s'));

        return $concierge;
    }

    public function fillClientLostConcierge($license_id,$crm_team,$clientInfo,$note,$username,$crm_link)
    {
        $concierge = $this->fillBasicConcierge($license_id,$crm_team,$clientInfo,$username,$crm_link);

        $concierge->setNote("Client lost.\n$note");

        return $concierge;
    }

    public function fillTurnedSaasConcierge($license_id,$crm_team,$clientInfo,$note,$date,$username,$crm_link)
    {
        $concierge = $this->fillBasicConcierge($license_id,$crm_team,$clientInfo,$username,$crm_link);

        $concierge->setNote("Turned to saas.Next contact: $date.\n$note");
        $concierge->setNextDate(new \DateTime($date));
        $concierge->setNextTime(new \DateTime($date));

        return $concierge;
    }

    public function addAgentToConcierge(Concierge $concierge,$username)
    {
        if (!$this->checkConciergeAgent($concierge)){

            $answer = $this->em->getRepository('DashboardBundle:ConciergeAnswerList')->findOneBy([
                "value" => $username
            ]);

            if ($answer){
                $question = $answer->getQuestion();
                $conciergeAnswer = new ConciergeAnswers();
                $conciergeAnswer->setQuestion($question);
                $conciergeAnswer->setAnswer($answer);
                $conciergeAnswer->setConcierge($concierge);
                $concierge->addAnswer($conciergeAnswer);
            }
        }

        return $concierge;
    }

    public function checkConciergeAgent(Concierge $concierge)
    {
        $answers = $concierge->getAnswers();

        $team = $concierge->getTeam();

        $question = $this->em->getRepository('DashboardBundle:ConciergeQuestions')->findOneBy([
            "value" => "Consultant",
            "team" => $team
        ]);


        /** @var ConciergeAnswers $answer */
        foreach ($answers as $answer){
            if ($answer->getQuestion()->getQuestionId() == $question->getQuestionId()){
                return true;
            }
        }
        return false;
    }

    public function getQuestionIdForConsultantQuestion(Teams $teams)
    {
        $question = $this->em->getRepository('DashboardBundle:ConciergeQuestions')->findOneBy([
            "value" => "Consultant",
            "team" => $teams
        ]);

        return $question->getQuestionId();
    }

    public function getNoConciergeList($team)
    {
        if ($this->cache->contains("{$team}.no.concierge.licenses")){
            return $this->cache->fetch("{$team}.no.concierge.licenses");
        }
        return false;
    }
}