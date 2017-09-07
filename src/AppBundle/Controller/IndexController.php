<?php
/**
 * Created by PhpStorm.
 * User: muszkin
 * Date: 03.04.17
 * Time: 12:41
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Team;
use AppBundle\Entity\User;
use AppBundle\Services\Provider\ConciergeProvider;
use AppBundle\Services\Remote\Shoper;
use AppBundle\Services\Remote\Whmcs;
use DashboardBundle\Entity\ConciergeAnswerList;
use DashboardBundle\Entity\ConciergeAnswers;
use DashboardBundle\Entity\ConciergeAnswerTags;
use DashboardBundle\Entity\ConciergeQuestions;
use DashboardBundle\Entity\ConciergeTagList;
use Mmoreram\GearmanBundle\Service\GearmanClient;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Finder\Finder;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * Class IndexController
 * @package AppBundle\Controller
 */
class IndexController extends Controller
{

    /**
     * @param Request $request
     * @return array
     * @Route("/",name="mainpage")
     * @Template("@App/panel/main.html.twig")
     */
    public function indexAction(Request $request)
    {
        $auth_checker = $this->get('security.authorization_checker');
        $token = $this->get('security.token_storage')->getToken();
        if ($auth_checker->isGranted("ROLE_ADMIN")) {
            /** @var User $user */
            $user = $token->getUser();

            /** @var User $team */
            $team = $user->getTeam()->getName();
            $finder = new Finder();
            $finder->in("public/data")->name($team . ".json");
            foreach ($finder as $file) {
                $promotions = json_decode($file->getContents());
                break;
            }
            return [
                "fullname" => $user->getFullname(),
                "currency" => $this->getParameter('app.teams')[$team]['symbol'],
                "promotions" => $promotions,
                "profile_picture" => $user->getProfilePicture(),

            ];
        } else {
            throw new AccessDeniedException("You are not allowed to be there");
        }
    }

    /**
     * @param $request
     * @Route("/call-list",name="call-list")
     * @Template("@App/panel/call.list.html.twig")
     * @throws \Exception
     * @return mixed
     */
    public function getCallList(Request $request)
    {
        $token = $this->get('security.token_storage')->getToken();
        $dashboard = $this->getDoctrine()->getManager("dashboard");
        $user = $token->getUser();


        $question = $dashboard->getRepository('DashboardBundle:ConciergeAnswerList')->findOneBy([
            "value" => $user->getFullname(),
        ]);

        $curDate = $request->request->get('curdate');

        if (!$question){
            return ["call_list" => null,"curDate" => $curDate];
        }

        $list = $dashboard->getRepository('DashboardBundle:Concierge')->getCallList($user->getFullname(),$question->getQuestion()->getQuestionId(), new \DateTime($curDate));

        return ["call_list" => $list,"curDate" => $curDate];
    }

    /**
     * @param Request $request
     * @return array
     * @Route("/client-data",name="client-data")
     * @Template("@App/panel/client.data.html.twig")
     */
    public function getClientData(Request $request)
    {
        $token = $this->get('security.token_storage')->getToken();
        $team = $token->getUser()->getTeam()->getName();

        $user_id = $request->request->get('client_id');
        $intercom_api = $this->get('intercom.api')->init();
        $clientInfo = $intercom_api->getUserIdInfo($user_id);

        $api_client = $this->get($this->getParameter('app.teams')[$team]['api']['api_service'])->init($this->getParameter('app.teams')[$team]['api'])->findClient($clientInfo->email);

        $crm_user_id = $api_client->getId();

        $crm_link = sprintf($this->getParameter('app.teams')[$team]['admin_panel_link'], $crm_user_id);
        $support_link = sprintf($this->getParameter('app.teams')[$team]['support_tickets_link'], $crm_user_id);

        if ($clientInfo->name == $clientInfo->email){
            $crm_name = $api_client->getName();
            if ($crm_name){
                $clientInfo->name = $crm_name;
            }
        }

        switch($team){
            case "shpr":
                break;
            case "zcin":
                if (substr($clientInfo->phone,0,1) != "0"){
                    $clientInfo->phone = "0".$clientInfo->phone;
                }
                break;
            case "zctr":
                if (substr($clientInfo->phone,0,1) == 9){
                    $clientInfo->phone = substr($clientInfo->phone,1);
                }
                break;
        }

        if(empty($clientInfo->phone)) {
            $clientStatus = $this->get('app.client.status');

            if ($clientStatus->checkClientPhoneEmailStatus($clientInfo->user_id)) {
                $clientInfo->phone = "Email sended";
            }
        }

        return [
            "client" => $clientInfo,
            "app_id" => $this->getParameter('app.teams')[$team]['intercom_app_id'],
            "crm_link" => $crm_link,
            "support_link" => $support_link
        ];
    }

    /**
     * @return mixed
     * @Template("@App/panel/no.concierge.list.html.twig")
     * @Route("/no-concierge-list",name="no-concierge-list")
     */
    public function getLicensesWithoutConcierges()
    {
        $token = $this->get('security.token_storage')->getToken();
        if ($token->getUser() instanceof User) {
            $team = $token->getUser()->getTeam();

            $conciergeProvider = $this->get('app.concierge.provider');
            /** @var ConciergeProvider $conciergeProvider */

            /** @var Team $team */
            if (!is_array($conciergeProvider->getNoConciergeList($team->getName())) && $team->isNoConciergeLock()) {
                return new JsonResponse(["status" => "working"]);
            } else if (is_array($conciergeProvider->getNoConciergeList($team->getName())) && !$team->isNoConciergeLock()) {
                return ["licenses" => $conciergeProvider->getNoConciergeList($team->getName())];
            } else if (!is_array($conciergeProvider->getNoConciergeList($team->getName())) && !$team->isNoConciergeLock()) {
                /** @var GearmanClient $gearman */
                $gearman = $this->get('gearman');
                try {
                    $gearman->doBackgroundJob('AppBundleWorkerNoConciergeWorker~process', serialize(['team' => $team->getName()]));
                } catch (\Exception $exception) {
                    $this->get('logger')->error($exception->getTraceAsString());
                }

                return new JsonResponse(["status" => "work placed"]);
            }
        }
        return new JsonResponse(["status" => "wait"]);

    }

    /**
     * @return mixed
     * @Route("/no-concierge-list-reset",name="no-concierge-list-reset")
     */
    public function clearCacheNoConciergeList()
    {
        $token = $this->get('security.token_storage')->getToken();
        $team = $token->getUser()->getTeam();

        /** @var Team $team */
        /** @var GearmanClient $gearman */
        $gearman = $this->get('gearman');
        try{
            $gearman->doBackgroundJob('AppBundleWorkerNoConciergeWorker~process',serialize(['team' => $team->getName()]));
        }catch (\Exception $exception){
            $this->get('logger')->error($exception->getTraceAsString());
        }

        return new JsonResponse(["reset"=>1]);
    }

    /**
     * @return array
     * @Template("@App/panel/client.lisenses.html.twig")
     * @Route("/client-licenses",name="client-licenses")
     */
    public function getClientLicenses(Request $request)
    {
        $email = $request->request->get('email');

        $token = $this->get('security.token_storage')->getToken();
        $team = $token->getUser()->getTeam()->getName();

        $intercomApi = $this->get('intercom.api')->init();

        $dashboard = $this->getDoctrine()->getManager('dashboard');

        $api_client = $this
            ->get($this->getParameter('app.teams')[$team]['api']['api_service'])
            ->init($this->getParameter('app.teams')[$team]['api'])
            ->findClient($email);

        $api_client->getProductsForClient($api_client->getId());

        $crm_licenses = $api_client->getLicenses();

        foreach ($crm_licenses as $key => $license) {

            $license_id = $license['license_id']['int'];
            if ($license_id) {
		        try {
        	        $currentLicenseInfo = $intercomApi->getUserIdInfo($license_id);
	                $crm_licenses[$key]['type'] = $currentLicenseInfo->custom_attributes->license_type;
		        }catch(\Exception $exception){
			        $crm_licenses[$key]['type'] = 'trial';
		        }
            }
            $teamCrm = $dashboard->getRepository('DashboardBundle:Teams')->findOneBy([
                "name" => $team,
                "type" => 'staff'
            ]);

            $lastConciergeWithProspectAndLevel = $dashboard->getRepository('DashboardBundle:Concierge')->getLastConciergeWithProspectAndLevel($license_id, $teamCrm);
            $crm_licenses[$key]['prospect_status'] = $lastConciergeWithProspectAndLevel[$license_id]['status'];
            $crm_licenses[$key]['staff'] = $lastConciergeWithProspectAndLevel[$license_id]['staff'];

        }

        return ["licenses" => $crm_licenses];
    }

    /**
     * @param Request $request
     * @return array
     * @Template("@App/panel/last.concierge.data.html.twig")
     * @Route("/last-concierge",name="last-concierge")
     */
    public function getFullLastConciergeData(Request $request)
    {
        $license_id = $request->request->get('license_id');
        $token = $this->get('security.token_storage')->getToken();
        $team = $token->getUser()->getTeam()->getName();

        $dashboard = $this->getDoctrine()->getManager('dashboard');
        $teamWhmcs = $dashboard->getRepository('DashboardBundle:Teams')->findOneBy([
            "name" => $team,
            "type" => 'staff'
        ]);


        $concierge = $this->get('app.concierge.provider');

        $conciergeData = $concierge->getFullfilledLastConcierge($license_id,$teamWhmcs->getTeamId());

        return ["concierge" => $conciergeData];

    }
    /**
     * @param Request $request
     * @return array
     * @Template("@App/panel/notes.concierge.html.twig")
     * @Route("/concierge-notes",name="notes-concierge")
     */
    public function getConciergeNotes(Request $request)
    {
        $license_id = $request->request->get('license_id');
        $token = $this->get('security.token_storage')->getToken();
        $team = $token->getUser()->getTeam()->getName();

        $dashboard = $this->getDoctrine()->getManager('dashboard');
        $teamCrm = $dashboard->getRepository('DashboardBundle:Teams')->findOneBy([
            "name" => $team,
            "type" => 'staff'
        ]);

        $concierge = $this->get('app.concierge.provider');

        $notes = $concierge->getConciergeNotes($license_id,$teamCrm);

        return ["notes" => $notes];
    }

    /**
     * @param Request $request
     * @Route("/prospect-and-level",name="prospect-and-level")
     * @Template("@App/panel/statuses.html.twig")
     * @return array
     */
    public function getAllProspectAndLevel(Request $request)
    {
        $license_id = $request->request->get('license_id');
        $token = $this->get('security.token_storage')->getToken();
        $team = $token->getUser()->getTeam()->getName();

        $dashboard = $this->getDoctrine()->getManager('dashboard');
        $teamCrm = $dashboard->getRepository('DashboardBundle:Teams')->findOneBy([
            "name" => $team,
            "type" => 'staff'
        ]);

        $concierge = $this->get('app.concierge.provider');

        $statuses = $concierge->getAllProspectAndLevel($license_id,$teamCrm);

        $percent = 100 / count($statuses);

        return ["statuses" => $statuses,"percent" => "width:".$percent."%"];
    }

    /**
     * @param Request $request
     * @return array
     * @Route("/concierge-modal",name="concierge-modal")
     * @Template("@App/panel/modals/concierge.modal.html.twig")
     */
    public function conciergeModal(Request $request)
    {
        $license_id = $request->request->get('license_id');
        $crm_client_id = $request->request->get('crm_client_id');
        $crm_license_id = $request->request->get('crm_license_id');
        $token = $this->get('security.token_storage')->getToken();
        $team = $token->getUser()->getTeam()->getName();

        $dashboard = $this->getDoctrine()->getManager('dashboard');
        $teamCrm = $dashboard->getRepository('DashboardBundle:Teams')->findOneBy([
            "name" => $team,
            "type" => 'staff'
        ]);

        $questionsAnswers = [];
        $conciergeProvider = $this->get('app.concierge.provider');

        $consulatantQuestionId = $conciergeProvider->getQuestionIdForConsultantQuestion($teamCrm);

        $questions = $dashboard->getRepository('DashboardBundle:ConciergeQuestions')->findBy(
            ['team' => $teamCrm,
                'type' => ['single','multi']
            ]);

        /** @var ConciergeQuestions $question */
        foreach ($questions as $question){
            if ($question->getQuestionId() == $consulatantQuestionId){
                continue;
            }
            $questionsAnswers[$question->getQuestionId()] =
                [
                    "question_id" => $question->getQuestionId(),
                    "value" => $question->getValue(),
                    "type" => $question->getType(),
            ];
            /** @var ConciergeAnswerList $answer */
            foreach ($question->getAnswers() as $answer){
                $questionsAnswers[$question->getQuestionId()]['answers'][] =
                    [
                        "answer_id" => $answer->getAnswerId(),
                        "value" => $answer->getValue(),
                        "ic_tag" => $answer->getIcTag()
                    ];

            }
            if ($question->getType() == 'multi') {
                $tags = $dashboard->getRepository('DashboardBundle:ConciergeTagList')->getAllTags();
                /** @var ConciergeTagList $tag */
                $questionsAnswers[$question->getQuestionId()] =
                    [
                        "question_id" => $question->getQuestionId(),
                        "value" => $question->getValue(),
                        "type" => $question->getType(),
                ];
                foreach ($tags as $tag){
                    $questionsAnswers[$question->getQuestionId()]['answers'][] =
                        [
                            "tag_id" => $tag->getTagId(),
                            "value" => $tag->getTag(),
                            "ic_tag" => $tag->getIcTag()
                        ];
                }
            }
        }

        $intercom_api = $this->get('intercom.api')->init();
        $clientInfo = $intercom_api->getUserIdInfo($license_id);

        $crm_link = $this->getParameter('app.teams')[$team]['crm_link'];

        $conciergeData = $this
            ->get($this->getParameter('app.teams')[$team]['api']['api_service'])
            ->init($this->getParameter('app.teams')[$team]['api'])
            ->findClient($clientInfo->email)
            ->getConciergeData($license_id,$crm_license_id,$crm_client_id,$crm_link,$clientInfo);



        $lastAnswers = $conciergeProvider->getLastConciergeData($teamCrm,$license_id);

        if ($lastAnswers){
            /** @var ConciergeAnswers $answer */
            foreach ($lastAnswers->getAnswers() as $answer){
                if (isset($questionsAnswers[$answer->getQuestion()->getQuestionId()])){
                    foreach($questionsAnswers[$answer->getQuestion()->getQuestionId()]['answers'] as $key => $answers){
                        if ($answers['answer_id'] == $answer->getAnswer()->getAnswerId()){
                            $questionsAnswers[$answer->getQuestion()->getQuestionId()]['answers'][$key]['set'] = true;
                        }
                    }
                }
            }
            $selectedTags = [];
            /** @var ConciergeAnswerTags $tag */
            foreach ($lastAnswers->getTags() as $tag){
                $selectedTags[] = $tag->getTag()->getTagId();
            }

            foreach ($questionsAnswers as $key => $questionsAnswer){
                if ($questionsAnswer['type'] == 'multi'){
                    foreach ($questionsAnswer['answers'] as $k => $tag){
                        if (in_array($tag['tag_id'],$selectedTags)){
                            $questionsAnswers[$key]['answers'][$k]['set'] = true;
                        }
                    }
                }
            }
        }

        return ['questions' => $questionsAnswers,"concierge_data" => $conciergeData];
    }

    /**
     * @param Request $request
     * @return string
     * @Route("/save-concierge",name="save-concierge")
     */
    public function saveConcierge(Request $request)
    {
        $dashboard = $this->getDoctrine()->getManager('dashboard');
        $token = $this->get('security.token_storage')->getToken();
        $team = $token->getUser()->getTeam()->getName();
        $teamCrm = $dashboard->getRepository('DashboardBundle:Teams')->findOneBy([
            "name" => $team,
            "type" => 'staff'
        ]);

        $payload = $request->request->getIterator()->getArrayCopy();
        $payload['next_date'] = new \DateTime($payload['date']);
        $payload['next_time'] = new \DateTime($payload['date']);
        $username = $token->getUser()->getFullname();
        $timeMatters = $payload['time_matters'];

        $concierge = $this->get('app.concierge.provider')->parseConciergeFormData($payload,$username,$teamCrm);

        $concierge->setDate(new \DateTime());

        if (empty($payload['note'])){
            $note = "";
        }else{
            $note = "Note:\n".$payload['note'];
        }

        $nextDate = new \DateTime($payload['date']);
        $date = $nextDate->format('Y-m-d H:i:s');
        $concierge->setNote("Concierge made by $username, next date: $date.$note");
        $concierge->setTimeMatters($timeMatters);

        $dashboard->persist($concierge);
        $dashboard->flush();

        return new JsonResponse(["retrived" => 1]);
    }

    /**
     * @param Request $request
     * @Route("/postpone-modal",name="postpone-modal")
     * @Template("@App/panel/modals/postpone.modal.html.twig")
     */
    public function postponeModal(Request $request)
    {

    }

    /**
     * @param Request $request
     * @Route("/postpone-save",name="postpone-save")
     * @return mixed
     */
    public function postponeSave(Request $request)
    {
        $dashboard = $this->getDoctrine()->getManager('dashboard');
        $token = $this->get('security.token_storage')->getToken();
        $team = $token->getUser()->getTeam()->getName();
        $teamCrm = $dashboard->getRepository('DashboardBundle:Teams')->findOneBy([
            "name" => $team,
            "type" => 'staff'
        ]);

        $license_id = $request->request->get('license_id');
        $crm_client_id = $request->request->get('crm_client_id');
        $crm_license_id = $request->request->get('crm_license_id');
        $timeMatters = $request->request->get('time_matters');

        $intercom_api = $this->get('intercom.api')->init();
        $clientInfo = $intercom_api->getUserIdInfo($license_id);

        $api_client = $this
            ->get($this->getParameter('app.teams')[$team]['api']['api_service'])
            ->init($this->getParameter('app.teams')[$team]['api'])
            ->findClient($clientInfo->email);

        if ($clientInfo->name == $clientInfo->email){
            $crm_name = $api_client->getName();
            if ($crm_name){
                $clientInfo->name = $crm_name;
            }
        }

        $crm_link = $api_client->getCrmLink(
            $this->getParameter('app.teams')[$team]['crm_link'],
            $crm_client_id,
            $crm_license_id
        );

        $date = new \DateTime($request->request->get('date'));
        $nextDate = new \DateTime($date->format('Y-m-d'));
        $nextTime = new \DateTime($date->format('H:i:s'));

        $note = $request->request->get('note');

        $concierge = $this
            ->get('app.concierge.provider')
            ->fillPostponedConcierge($license_id,$teamCrm,$clientInfo,$nextDate,$nextTime,$note,$token->getUser()->getFullname(),$crm_link);

        $concierge->setTimeMatters($timeMatters);

        try {
            $dashboard->persist($concierge);
            $dashboard->flush();
        }catch(\Exception $exception){
            return new JsonResponse(["success" => false,"error" => $exception->getMessage()]);
        }
        return new JsonResponse(["success" => true]);
    }

    /**
     * @param Request $request
     * @Route("/not-related-modal",name="not-related-modal")
     * @Template("@App/panel/modals/notrelated.modal.html.twig")
     */
    public function notRelatedModal(Request $request)
    {

    }

    /**
     * @param Request $request
     * @return mixed
     * @Route("/not-related-save",name="not-related-save")
     */
    public function notRelatedSave(Request $request)
    {
        $dashboard = $this->getDoctrine()->getManager('dashboard');
        $token = $this->get('security.token_storage')->getToken();
        $team = $token->getUser()->getTeam()->getName();
        $teamCrm = $dashboard->getRepository('DashboardBundle:Teams')->findOneBy([
            "name" => $team,
            "type" => 'staff'
        ]);

        $license_id = $request->request->get('license_id');
        $crm_client_id = $request->request->get('crm_client_id');
        $crm_license_id = $request->request->get('crm_license_id');

        $intercom_api = $this->get('intercom.api')->init();
        $clientInfo = $intercom_api->getUserIdInfo($license_id);

        $api_client = $this
            ->get($this->getParameter('app.teams')[$team]['api']['api_service'])
            ->init($this->getParameter('app.teams')[$team]['api'])
            ->findClient($clientInfo->email);

        $crm_link = $api_client->getCrmLink(
            $this->getParameter('app.teams')[$team]['crm_link'],
            $crm_client_id,
            $crm_license_id
        );

        if ($clientInfo->name == $clientInfo->email){
            $crm_name = $api_client->getName();
            if ($crm_name){
                $clientInfo->name = $crm_name;
            }
        }

        $note = $request->request->get('note');

        $concierge = $this
            ->get('app.concierge.provider')
            ->fillNotRelatedConcierge($license_id,$teamCrm,$clientInfo,$note,$token->getUser()->getFullname(),$crm_link);

        try {
            $dashboard->persist($concierge);
            $dashboard->flush();
        }catch(\Exception $exception){
            return new JsonResponse(["success" => false,"error" => $exception->getMessage()]);
        }
        return new JsonResponse(["success" => true]);
    }

    /**
     * @Route("/not-answered-modal",name="not-answered-modal")
     * @Template("@App/panel/modals/notanswered.modal.html.twig")
     */
    public function notAnsweredModal()
    {

    }

    /**
     * @param Request $request
     * @Route("/not-answered-save",name="not-answered-save")
     * @return mixed
     */
    public function notAnsweredSave(Request $request)
    {
        $dashboard = $this->getDoctrine()->getManager('dashboard');
        $token = $this->get('security.token_storage')->getToken();
        $team = $token->getUser()->getTeam()->getName();
        $teamCrm = $dashboard->getRepository('DashboardBundle:Teams')->findOneBy([
            "name" => $team,
            "type" => 'staff'
        ]);

        $license_id = $request->request->get('license_id');
        $crm_client_id = $request->request->get('crm_client_id');
        $crm_license_id = $request->request->get('crm_license_id');

        $intercom_api = $this->get('intercom.api')->init();
        $clientInfo = $intercom_api->getUserIdInfo($license_id);

        $api_client = $this
            ->get($this->getParameter('app.teams')[$team]['api']['api_service'])
            ->init($this->getParameter('app.teams')[$team]['api'])
            ->findClient($clientInfo->email);

        $crm_link = $api_client->getCrmLink(
            $this->getParameter('app.teams')[$team]['crm_link'],
            $crm_client_id,
            $crm_license_id
        );

        if ($clientInfo->name == $clientInfo->email){
            $crm_name = $api_client->getName();
            if ($crm_name){
                $clientInfo->name = $crm_name;
            }
        }

        $date = $request->request->get('date');
        $nextDate = new \DateTime($date);
        $nextTime = new \DateTime($date);

        $concierge = $this
            ->get('app.concierge.provider')
            ->fillNotAnsweredConcierge($license_id,$teamCrm,$clientInfo,$nextDate,$nextTime,$token->getUser()->getFullname(),$crm_link);

        try {
            $dashboard->persist($concierge);
            $dashboard->flush();
        }catch(\Exception $exception){
            return new JsonResponse(["success" => false,"error" => $exception->getMessage()]);
        }
        return new JsonResponse(["success" => true]);
    }

    /**
     * @Route("/client-lost-modal",name="client-lost-modal")
     * @Template("@App/panel/modals/lost.modal.html.twig")
     */
    public function clientLostModal()
    {

    }

    /**
     * @param Request $request
     * @Route("/client-lost-save",name="client-lost-save")
     * @return mixed
     */
    public function clientLostSave(Request $request)
    {
        $dashboard = $this->getDoctrine()->getManager('dashboard');
        $token = $this->get('security.token_storage')->getToken();
        $team = $token->getUser()->getTeam()->getName();
        $teamCrm = $dashboard->getRepository('DashboardBundle:Teams')->findOneBy([
            "name" => $team,
            "type" => 'staff'
        ]);

        $license_id = $request->request->get('license_id');
        $crm_client_id = $request->request->get('crm_client_id');
        $crm_license_id = $request->request->get('crm_license_id');
        $note = $request->request->get('note');

        $intercom_api = $this->get('intercom.api')->init();
        $clientInfo = $intercom_api->getUserIdInfo($license_id);

        $api_client = $this
            ->get($this->getParameter('app.teams')[$team]['api']['api_service'])
            ->init($this->getParameter('app.teams')[$team]['api'])
            ->findClient($clientInfo->email);

        $crm_link = $api_client->getCrmLink(
            $this->getParameter('app.teams')[$team]['crm_link'],
            $crm_client_id,
            $crm_license_id
        );

        if ($clientInfo->name == $clientInfo->email){
            $crm_name = $api_client->getName();
            if ($crm_name){
                $clientInfo->name = $crm_name;
            }
        }

        $concierge = $this
            ->get('app.concierge.provider')
            ->fillClientLostConcierge($license_id,$teamCrm,$clientInfo,$note,$token->getUser()->getFullname(),$crm_link);

        try {
            $dashboard->persist($concierge);
            $dashboard->flush();
        }catch(\Exception $exception){
            return new JsonResponse(["success" => false,"error" => $exception->getMessage()]);
        }
        return new JsonResponse(["success" => true]);
    }

    /**
     * @Route("/turned-saas-modal",name="turned-saas-modal")
     * @Template("@App/panel/modals/turned.sass.modal.html.twig")
     */
    public function turnedSaasModal()
    {

    }

    /**
     * @param Request $request
     * @Route("/turned-saas-save",name="turned-saas-save")
     * @return mixed
     */
    public function turnedSaasSave(Request $request)
    {
        $dashboard = $this->getDoctrine()->getManager('dashboard');
        $token = $this->get('security.token_storage')->getToken();
        $team = $token->getUser()->getTeam()->getName();
        $teamCrm = $dashboard->getRepository('DashboardBundle:Teams')->findOneBy([
            "name" => $team,
            "type" => 'staff'
        ]);

        $license_id = $request->request->get('license_id');
        $crm_client_id = $request->request->get('crm_client_id');
        $crm_license_id = $request->request->get('crm_license_id');
        $note = $request->request->get('note');
        $date = $request->request->get('date');

        $intercom_api = $this->get('intercom.api')->init();
        $clientInfo = $intercom_api->getUserIdInfo($license_id);

        $api_client = $this
            ->get($this->getParameter('app.teams')[$team]['api']['api_service'])
            ->init($this->getParameter('app.teams')[$team]['api'])
            ->findClient($clientInfo->email);

        $crm_link = $api_client->getCrmLink(
            $this->getParameter('app.teams')[$team]['crm_link'],
            $crm_client_id,
            $crm_license_id
        );

        if ($clientInfo->name == $clientInfo->email){
            $crm_name = $api_client->getName();
            if ($crm_name){
                $clientInfo->name = $crm_name;
            }
        }

        $concierge = $this
            ->get('app.concierge.provider')
            ->fillTurnedSaasConcierge($license_id,$teamCrm,$clientInfo,$note,$date,$token->getUser()->getFullname(),$crm_link);

        try {
            $dashboard->persist($concierge);
            $dashboard->flush();
        }catch(\Exception $exception){
            return new JsonResponse(["success" => false,"error" => $exception->getMessage()]);
        }
        return new JsonResponse(["success" => true]);
    }

    /**
     * @Route("/no-phone-send-email",name="no-phone-send-email")
     */
    public function sendNoPhoneEmail(Request $request)
    {
        $crm_client_email = $request->request->get('crm_client_email');
        $license_id = $request->request->get('license_id');
        $token = $this->get('security.token_storage')->getToken();
        $team = $token->getUser()->getTeam()->getName();

        /** @var Whmcs|Shoper $api_client */
        $api_client = $this
            ->get($this->getParameter('app.teams')[$team]['api']['api_service'])
            ->init($this->getParameter('app.teams')[$team]['api']);
        $mail_status = $api_client->noPhoneSendEmail($crm_client_email,$this->getParameter('app.teams')[$team]['api']['email_template']);

        $intercom_api = $this->get('intercom.api')->init();
        $clientInfo = $intercom_api->getUserIdInfo($license_id);


        $this->get('app.client.status')->setClientStatusEmail($clientInfo->user_id,$clientInfo->id,$mail_status);

        if ($mail_status){
            return new JsonResponse(['success' => true]);
        }
        return new JsonResponse(['success' => false]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @Route("/makeCall",name="makeCall")
     */
    public function makeCall(Request $request)
    {
        $phone_number = trim($request->request->get("phone"));
        $token = $this->get('security.token_storage')->getToken();
        /** @var User $user */
        $user = $token->getUser();
        $sip = $user->getSip();

        $thulium = $this->get('app.thulium.service');

        return new JsonResponse($thulium->makeCall($sip,$phone_number));
    }

    /**
     * @return JsonResponse
     * @Route("/hangUpCall",name="hangUpCall")
     */
    public function hangUpCall()
    {
        $token = $this->get('security.token_storage')->getToken();
        /** @var User $user */
        $user = $token->getUser();

        $thulium = $this->get('app.thulium.service');

        return new JsonResponse($thulium->hangUpCall($user));
    }

}
