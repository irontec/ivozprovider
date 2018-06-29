<?php

use Ivoz\Core\Infrastructure\Domain\Service\Cgrates\BillingService;
use Ivoz\Core\Application\Service\DataGateway;
use \Ivoz\Cgr\Domain\Model\TpRatingProfile\SimulatedCall;

class KlearCustomTarificatorController extends Zend_Controller_Action
{
    protected $_mainRouter;

    protected $_brandId;

    public function init ()
    {
        /**
         * Initialize action controller here
         */
        if ((! $this->_mainRouter = $this->getRequest()->getUserParam(
                "mainRouter")) || (! is_object($this->_mainRouter))) {
            throw new Zend_Exception("",
                Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ACTION);
        }

        $this->_helper->ContextSwitch()
            ->addActionContext("test-company-plans", "json")
            ->addActionContext("test-brand-plans", "json")
            ->addActionContext("test-rating-plan", "json")
            ->addActionContext("tarificate-call", "json")
            ->initContext("json");

        $this->_helper->layout->disableLayout();

        $auth = Zend_Auth::getInstance();
        if (!$auth->hasIdentity()) {
            throw new \Klear_Exception_Default("No brand emulated");
        }
        $loggedUser = $auth->getIdentity();
        $this->_brandId = $loggedUser->brandId;
    }

    public function tarificateCallAction ()
    {
        $pks = $this->getRequest()->getParam("pk");
        if (!is_array($pks) && !is_null($pks)) {
            $pks = array($pks);
        }

        $runTarificator = $this->getParam("tarificate");
        if ($runTarificator) {
            $this->_helper->log("[Tarificator] Tarificate selected calls");
            return $this->retarificate($pks);
        }

        $title = $this->_helper->translate("Tarificate Calls?");
        $message = "<p>".$this->_helper->translate("Do you want to rerate selected calls?")."</p>";
        $this->_showDialog($title, $message, "Ok", "Cancel", false, "300", "100");
    }

    /**
     * @param $pks
     * @return boolean
     */
    protected function _checkRetarificables($pks)
    {
        /** @var DataGateway $dataGateway */
        $dataGateway = \Zend_Registry::get('data_gateway');
        return $dataGateway->runNamedQuery(
            \Ivoz\Kam\Domain\Model\TrunksCdr\TrunksCdr::class,
            'areRetarificable',
            [$pks]
        );
    }


    public function testCompanyPlansAction ()
    {
        $argumentsResolver = function () {
            /** @var DataGateway $dataGateway */
            $dataGateway = \Zend_Registry::get('data_gateway');

            /** @var \Ivoz\Provider\Domain\Model\Company\CompanyDto $companyDto */
            $companyDto = $dataGateway->find(
                \Ivoz\Provider\Domain\Model\Company\Company::class,
                $this->getParam("parentId")
            );

            $callDuration = $this->getParam('duration');
            if ($callDuration < 1) {
                $callDuration = 60;
            }

            return [
                [
                    $callDuration,
                    'b' . $companyDto->getBrandId(),
                    'c' . $companyDto->getId()
                ]
            ];
        };

        $this->testPlans(
            'simulateCall',
            $argumentsResolver
        );
    }

    public function testBrandPlansAction()
    {
        $argumentsResolver = function () {

            $auth = Zend_Auth::getInstance();
            if (!$auth->hasIdentity()) {
                throw new \Klear_Exception_Default("No brand emulated");
            }
            $loggedUser = $auth->getIdentity();
            $brandId = $loggedUser->brandId;

            $callDuration = $this->getParam('duration');
            if ($callDuration < 1) {
                $callDuration = 60;
            }

            /** @var DataGateway $dataGateway */
            $dataGateway = \Zend_Registry::get('data_gateway');

            /** @var \Ivoz\Cgr\Domain\Model\RatingPlan\RatingPlanDto[] $ratingPlans */
            $ratingPlans = $dataGateway->findBy(
                \Ivoz\Cgr\Domain\Model\RatingPlan\RatingPlan::class,
                [
                    'RatingPlan.brand = :brand',
                    ['brand' => $brandId]
                ]
            );

            $arguments = [];
            foreach ($ratingPlans as $ratingPlan) {
                $arguments[] = [
                    $callDuration,
                    'b' . $brandId,
                    $ratingPlan->getTag()
                ];
            }

            return $arguments;
        };

        $this->testPlans(
            'simulateCallByRatingPlan',
            $argumentsResolver
        );
    }

    public function testRatingPlanAction()
    {
        $argumentsResolver = function () {

            $auth = Zend_Auth::getInstance();
            if (!$auth->hasIdentity()) {
                throw new \Klear_Exception_Default("No brand emulated");
            }
            $loggedUser = $auth->getIdentity();
            $brandId = $loggedUser->brandId;

            $callDuration = $this->getParam('duration');
            if ($callDuration < 1) {
                $callDuration = 60;
            }

            /** @var DataGateway $dataGateway */
            $dataGateway = \Zend_Registry::get('data_gateway');

            /** @var \Ivoz\Cgr\Domain\Model\RatingPlan\RatingPlanDto[] $ratingPlans */
            $ratingPlan = $dataGateway->find(
                \Ivoz\Cgr\Domain\Model\RatingPlan\RatingPlan::class,
                $this->getParam('parentId')
            );

            return [
                [
                    $callDuration,
                    'b' . $brandId,
                    $ratingPlan->getTag()
                ]
            ];
        };

        $this->testPlans(
            'simulateCallByRatingPlan',
            $argumentsResolver
        );
    }

    protected function testPlans(string $handler, callable $callArgumentsResolver)
    {
        if (!$this->getParam("tarificate")) {
            return $this->_confirmDialog();
        }

        $errors = $this->_getFormErrors();
        if (!is_null($errors)) {
            return $this->_confirmDialog($errors);
        }

        try {

            $number = $this->getParam('number');
            if ($number[0] !== '+') {
                $errorMsg = $this->_helper->translate(
                    'Phone number must be in E.164 format (prefixed by "+" symbol)'
                );
                throw new \DomainException($errorMsg);
            }

            $responses = [];
            foreach ($callArgumentsResolver() as $simulateCallArgument) {
                $responses[] = $this->{$handler}(
                    ...$simulateCallArgument
                );
            }
            $message = $this->_getTarificationInfo($responses);

        } catch (\DomainException $e) {
            $message = $e->getMessage();
            $this->_helper->log("[Tarificator] domain error " . $message);
        }  catch (\Exception $e) {
            $message = $this->_helper->translate(
                'There was an error'
            );
            $this->_helper->log("[Tarificator] error " . $message);
        }

        $title = $this->_helper->translate("Results");
        $this->_showDialog(
            $title,
            $message,
            false,
            "Close",
            false,
            '80%'
        );
    }

    protected function _confirmDialog ($errorMessage = "")
    {
        $title = $this->_helper->translate("Rating Profile Tester");
        $message = $errorMessage;
        $message .= "<form>";
        $message .= "<table class='kMatrix'>";
        $message .=     "<tr>";
        $message .=         "<th class='ui-widget-header multiItem notSortable'>";
        $message .=             $this->_helper->translate("Phone number");
        $message .=         "</th>";
        $message .=         "<th class='ui-widget-header multiItem notSortable'>";
        $message .=             $this->_helper->translate("Duration");
        $message .=             ' (';
        $message .=             $this->_helper->translate("seconds");
        $message .=             ')';
        $message .=         "</th>";
        $message .=     "</tr>";
        $message .=     "<tr>";
        $message .=         "<td class='ui-widget-content'>";
        $message .=             '<input type="text" id="number" name="number" placeholder="+34123456789" class="ui-widget ui-state-default ui-corner-all" pattern="\\+[0-9]+"';
        $message .=                 'required value="'.$this->getParam("number").'">';
        $message .=         "</td>";
        $message .=         "<td class='ui-widget-content'>";
        $message .=             '<input type="number" name="duration" value="60" min="1" placeholder="value in seconds" class="ui-widget ui-state-default ui-corner-all"';
        $message .=                 ' value="'.$this->getParam("duration").'">';
        $message .=         "</td>";
        $message .=     "</tr>";
        $message .= "</table>";
        $message .= "</form>";

        $this->_showDialog($title, $message, $this->_helper->translate("Test"), "Close", false, "auto");
    }

    protected function _getFormErrors()
    {
        $errors = false;
        $errorMessage = "";

        if (!is_numeric($this->getParam("number"))) {
            $errors = true;
            $errorMessage .= "<p><font color='red'>" .
                $this->_helper->translate("Please, type a phone number") . ".</font></p>";
        }

        if (! is_numeric($this->getParam("duration"))) {
            $errors = true;
            $errorMessage .= "<p><font color='red'>" .$this->_helper->translate("Please, type a duration in seconds")
                .".</font></p>";
        }

        if ($errors) {
            $errorMessage .= "<br>";
            return $errorMessage;
        } else {
            return null;
        }
    }

    /**
     * @param SimulatedCall[] $response
     * @return string
     */
    protected function _getTarificationInfo(array $responses)
    {
        $headers = [
            'Plan',
            'Call date',
            'Duration',
            'Pattern Name',
            'Con. Charge',
            'Interval start',
            'Rate',
            'Total cost',
        ];
        $rows = [];

        foreach ($responses as $response) {

            $ratingPlanName = $response->getRatingPlan()->getNameEn();

            if ($response->getErrorMessage()) {
                $errorMsg = '';
                switch ($response->getErrorCode()) {
                    case SimulatedCall::ERROR_UNAUTHORIZED_DESTINATION:
                        $errorMsg = $this->_helper->translate(
                            'Active pricing plan does not allow to call introduced phone number'
                        );
                        break;
                    case SimulatedCall::ERROR_NO_RATING_PLAN;
                        $errorMsg = $this->_helper->translate(
                            'Destination rate not found'
                        );
                        break;
                }

                $rows[] = [
                    'Plan' => $ratingPlanName,
                    'error' => $errorMsg
                ];
                continue;
            }

            $chargePeriod = $response->getChargePeriod();
            $rate = $response->getRate()
                ? $response->getRate() . ' / ' . $chargePeriod . ' ' . $this->_helper->translate('seconds')
                : '';

            $cost = $response->getCost() + $response->getConnectionFee();

            $rows[] = [
                'Plan' => $ratingPlanName,
                'Call date' => $response->getCallDate()->format('Y-m-d H:i:s'),
                'Duration' => $response->getCallDuration() . ' ' . $this->_helper->translate('seconds'),
                'Pattern Name' => $response->getPatternName() . ' (' . $response->getPrefix() . ')',
                'Con. Charge' => $response->getConnectionFee(),
                'Interval start' => $response->getIntervalStart(),
                'Rate' => $rate,
                'Total cost' => $cost,
            ];
        }


        $info = $this->_drawTable(
            $headers,
            $rows,
            $this->getParam('number')
        );

        return $info;
    }

    protected function _drawTable($fieldNames, $array, $dest=null, $duration = null)
    {
        $table = '<table class="kMatrix" style="min-width: 850px;">';
        if (!is_null($dest)) {
            $table .= '<caption class="ui-state-active ui-priority-primary">'.$dest;
            if (!is_null($duration)) {
                $table .= '<span class="extraCaptionInfo">'.$duration." ".$this->_helper->translate("seconds")."</span>";
            }
        }
        $table .= '<tbody>';
        $table .= "<tr>";
        foreach ($fieldNames as $fieldName) {
            $table .= "<th class='ui-widget-header multiItem notSortable'>";
            $table .= $this->_helper->translate($fieldName);
            $table .= "</th>";
        }
        $table .= "</tr>";

        foreach ($array as $row) {
            $table .= "<tr>";
            foreach ($row as $key => $field) {

                $colspan = $key === 'error'
                    ? count($fieldNames) - count(array_keys($row)) + 1
                    : 1;

                $table .= "<td colspan='$colspan' class='ui-widget-content tarificator' style='width: 10%; text-align: center;'>";
                $table .= $field;
                $table .= "</td>";
            }
            $table .= "</tr>";
        }
        $table .= '</tbody>';
        $table .= "</table>";
        return $table;
    }

    protected function _showDialog ($title = "Title", $message = "Message", $ok = "Ok",
                                    $close = "Close", $reloadParent = false, $width = "1000", $height = "auto")
    {
        $ok = $this->_helper->translate($ok);
        $close = $this->_helper->translate($close);

        if (! $ok) {
            $data = array(
                'title' => $title,
                'message' => $message,
                "options" => array(
                    "width" => $width,
                    'height' => $height,
                ),
                'buttons' => array(
                    $close => array(
                        "recall" => false,
                        "reloadParent" => false
                    )
                )
            );
        } else {
            $data = array(
                'title' => $title,
                'message' => $message,
                "options" => array(
                    "width" => $width,
                    'height' => $height,
                ),
                'buttons' => array(
                    $close => array(
                        "recall" => false,
                        "reloadParent" => false
                    ),
                    $ok => array(
                        "recall" => true,
                        "reloadParent" => $reloadParent,
                        "params" => array(
                            "tarificate" => true
                        )
                    )
                )
            );
        }
        $this->_dispatch($data);
    }

    protected function _dispatch (array $data)
    {
        $jsonResponse = new Klear_Model_DispatchResponse();
        $jsonResponse->setModule('default');
        $jsonResponse->setPlugin('customTarificator');
        $jsonResponse->addJsFile("/../klearMatrix/js/plugins/jquery.klearmatrix.genericdialog.js");
        $jsonResponse->addJsFile("/js/customTarificator.js");
        $jsonResponse->setData($data);
        $jsonResponse->attachView($this->view);
    }

    /**
     * @param $pks
     */
    protected function retarificate($pks)
    {
        $retarificable = $this->_checkRetarificables($pks);
        if ($retarificable) {

            $serviceContainer = \Zend_Registry::get('container');
            $rerateService = $serviceContainer->get(
                \Ivoz\Core\Infrastructure\Domain\Service\Cgrates\RerateCallService::class
            );

            $rerateService->execute($pks);
            $message = "<p>" . $this->_helper->translate("Tarificator Job started") . "</p>";
            $title = $this->_helper->translate("Ok");

        } else {

            $message = "<p>".$this->_helper->translate("Invoiced calls can't be metered again")."</p>";
            $message .= "<p>".$this->_helper->translate("Please select only uninvoiced calls")."</p>";

            $title = $this->_helper->translate("Error");
        }

        $this->_showDialog(
            $title,
            $message,
            false,
            "Ok",
            false,
            "300",
            "100"
        );
    }

    /**
     * @param $callDuration
     * @param $tenant
     * @param $subject
     * @return SimulatedCall
     */
    private function simulateCall($callDuration, $tenant, $subject)
    {
        $container = \Zend_Registry::get('container');

        /** @var CompanyBillingService $billingService */
        $billingService = $container->get(BillingService::class);

        return $billingService->simulateCall(
            $tenant,
            $subject,
            $this->getParam('number'),
            $callDuration
        );
    }

    /**
     * @param $callDuration
     * @param $tenant
     * @param $ratingPlanId
     * @return SimulatedCall
     */
    private function simulateCallByRatingPlan($callDuration, $tenant, $ratingPlanId)
    {
        $container = \Zend_Registry::get('container');

        /** @var CompanyBillingService $billingService */
        $billingService = $container->get(BillingService::class);

        return $billingService->simulateCallByRatingPlan(
            $tenant,
            $ratingPlanId,
            $this->getParam('number'),
            $callDuration
        );
    }
}
