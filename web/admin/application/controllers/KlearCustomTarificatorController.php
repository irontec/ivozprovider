<?php

use Ivoz\Core\Infrastructure\Domain\Service\Cgrates\BillingService;
use Ivoz\Core\Application\Service\DataGateway;
use Ivoz\Cgr\Domain\Model\TpRatingProfile\SimulatedCall;
use Ivoz\Provider\Domain\Model\Brand\Brand;
use Ivoz\Provider\Domain\Model\Carrier\Carrier;
use Ivoz\Provider\Domain\Model\Carrier\CarrierDto;
use Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Provider\Domain\Model\RatingPlanGroup\RatingPlanGroupDto;
use Ivoz\Provider\Domain\Model\RatingPlanGroup\RatingPlanGroupsDto;
use Ivoz\Provider\Domain\Model\RatingPlanGroup\RatingPlanGroup;

class KlearCustomTarificatorController extends Zend_Controller_Action
{
    protected $_mainRouter;

    protected $_brandId;

    protected $_companyId;

    public function init()
    {
        /**
         * Initialize action controller here
         */
        if ((! $this->_mainRouter = $this->getRequest()->getUserParam(
            "mainRouter"
        )) || (! is_object($this->_mainRouter))) {
            throw new Zend_Exception(
                "",
                Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ACTION
            );
        }

        $this->_helper->ContextSwitch()
            ->addActionContext("test-company-plans", "json")
            ->addActionContext("test-carrier-plans", "json")
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
        $this->_companyId = $loggedUser->companyId;
    }

    public function tarificateCallAction()
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
            \Ivoz\Provider\Domain\Model\BillableCall\BillableCall::class,
            'areRetarificable',
            [$pks]
        );
    }

    public function testCarrierPlansAction()
    {
        $dataGateway = \Zend_Registry::get('data_gateway');

        /** @var CarrierDto $carrierDto */
        $carrierDto = $dataGateway->find(
            Carrier::class,
            $this->getParam("parentId")
        );

        $argumentsResolver = function () use ($dataGateway, $carrierDto) {

            $callDuration = $this->getParam('duration');
            if ($callDuration < 1) {
                $callDuration = 60;
            }

            $subject = $dataGateway->remoteProcedureCall(
                Carrier::class,
                $carrierDto->getId(),
                'getCgrSubject',
                []
            );

            $brandTenant = $dataGateway->remoteProcedureCall(
                Brand::class,
                $carrierDto->getBrandId(),
                'getCgrTenant',
                []
            );

            return [
                [
                    $callDuration,
                    $brandTenant,
                    $subject
                ]
            ];
        };

        $this->testPlans(
            'simulateCall',
            $argumentsResolver,
            false
        );
    }


    public function testCompanyPlansAction()
    {
        $dataGateway = \Zend_Registry::get('data_gateway');

        /** @var \Ivoz\Provider\Domain\Model\Company\CompanyDto $companyDto */
        $companyDto = $dataGateway->find(
            Company::class,
            $this->getParam("parentId", $this->_companyId)
        );

        $argumentsResolver = function () use ($dataGateway, $companyDto) {

            $callDuration = $this->getParam('duration');
            if ($callDuration < 1) {
                $callDuration = 60;
            }

            $subject = 'c' . $companyDto->getId();
            $routingTag = $this->getParam('routingTag');
            if ($routingTag) {
                $subject .= 'rt' . $routingTag;
            }

            $brandTenant = $dataGateway->remoteProcedureCall(
                Brand::class,
                $companyDto->getBrandId(),
                'getCgrTenant',
                []
            );

            return [
                [
                    $callDuration,
                    $brandTenant,
                    $subject
                ]
            ];
        };


        $companyType = is_null($companyDto)
            ? ''
            : $companyDto->getType();

        $showRatingTags = in_array(
            $companyType,
            [Company::WHOLESALE, Company::RETAIL]
        );

        $this->testPlans(
            'simulateCall',
            $argumentsResolver,
            $showRatingTags
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

            /** @var RatingPlanGroupDto[] $ratingPlans */
            $ratingPlanGroups = $dataGateway->findBy(
                RatingPlanGroup::class,
                [
                    'RatingPlanGroup.brand = :brand',
                    ['brand' => $brandId]
                ]
            );

            $arguments = [];
            foreach ($ratingPlanGroups as $ratingPlanGroup) {
                $cgrTag = $dataGateway->remoteProcedureCall(
                    RatingPlanGroup::class,
                    $ratingPlanGroup->getId(),
                    'getCgrTag',
                    []
                );

                $brandTenant = $dataGateway->remoteProcedureCall(
                    Brand::class,
                    $brandId,
                    'getCgrTenant',
                    []
                );

                $arguments[] = [
                    $callDuration,
                    $brandTenant,
                    $cgrTag
                ];
            }

            return $arguments;
        };

        $this->testPlans(
            'simulateCallByRatingPlan',
            $argumentsResolver,
            false
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

            $ratingPlanGroupTag = $dataGateway->remoteProcedureCall(
                RatingPlanGroup::class,
                $this->getParam('parentId', $this->_companyId),
                'getCgrTag',
                []
            );

            $brandTenant = $dataGateway->remoteProcedureCall(
                Brand::class,
                $brandId,
                'getCgrTenant',
                []
            );

            return [
                [
                    $callDuration,
                    $brandTenant,
                    $ratingPlanGroupTag
                ]
            ];
        };

        $this->testPlans(
            'simulateCallByRatingPlan',
            $argumentsResolver,
            false
        );
    }

    protected function testPlans(string $handler, callable $callArgumentsResolver, $showRatingTags)
    {
        if (!$this->getParam("tarificate")) {
            return $this->_confirmDialog($showRatingTags);
        }

        $errors = $this->_getFormErrors();
        if (!is_null($errors)) {
            return $this->_confirmDialog($showRatingTags, $errors);
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
        } catch (\Exception $e) {
            $message = $this->_helper->translate(
                'There was an error'
            ) . ":" .  $e->getMessage();
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

    protected function _confirmDialog($showRatingTags = false, $errorMessage = "")
    {
        $title = $this->_helper->translate("Rating Profile Tester");
        $message = $errorMessage;
        $message .= "<form>";
        $message .= "<table class='kMatrix'>";
        $message .=     "<tr>";

        if ($showRatingTags) {
            $message .=         "<th class='ui-widget-header multiItem notSortable'>";
            $message .=             \Klear_Model_Gettext::gettextCheck("ngettext('Routing Tag', 'Routing Tags', 0)");
            $message .=         "</th>";
        }

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

        if ($showRatingTags) {
            $routingTags = $this->_getRoutingTagArray();

            $message .=     "<td class='ui-widget-content' style='overflow: visible; min-width: 225px;'>";
            $message .=         '<style> .selectboxit-container .selectboxit { width: 220px!important; }</style>';
            $message .=         '<select id="routingTag" name="routingTag" class="ui-widget ui-state-default ui-corner-all">';
            $message .=             '<option value="">'. $this->_helper->translate('No routing tag') .'</option>';

            foreach ($routingTags as $routingTag) {
                $id = $routingTag->getId();
                $routingTagName = $routingTag->getName();
                $tag = $routingTag->getTag();

                $message .=         '<option value="'. $id .'">'. "$routingTagName ($tag)" .'</option>';
            }

            $message .=         '</select>';
            $message .=     "</td>";
        }

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


    protected function _getRoutingTagArray()
    {
        /** @var DataGateway $dataGateway */
        $dataGateway = \Zend_Registry::get('data_gateway');
        $companyId = $this->getRequest()->getParam("parentId", $this->_companyId);
        return $dataGateway->runNamedQuery(
            \Ivoz\Provider\Domain\Model\RoutingTag\RoutingTagInterface::class,
            'findByCompanyId',
            [$companyId]
        );
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
            'Start time',
            'Duration',
            'Destination',
            'Connection fee',
            'Interval start',
            'Price',
            'Total',
        ];
        $rows = [];

        foreach ($responses as $response) {
            $ratingPlanGroup = $response->getRatingPlanGroup();
            $ratingPlanGroupName = ($ratingPlanGroup)
                    ? $ratingPlanGroup->getNameEn()
                    : "";

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
                    'Plan' => $ratingPlanGroupName,
                    'error' => $errorMsg
                ];
                continue;
            }

            /** @var DataGateway $dataGateway */
            $dataGateway = \Zend_Registry::get('data_gateway');

            $currencySymbol = $dataGateway->remoteProcedureCall(
                RatingPlanGroup::class,
                $ratingPlanGroup->getId(),
                'getCurrencySymbol',
                []
            );

            $chargePeriod = $response->getChargePeriod();
            $rate = $response->getRate()
                ? $response->getRate() . " $currencySymbol / " . $chargePeriod . ' ' . $this->_helper->translate('seconds')
                : '';

            $cost = $response->getCost() + $response->getConnectionFee();

            $callDate = $response->getCallDate();
            $callDate
                ->setTimezone(
                    new \DateTimeZone(date_default_timezone_get())
                );

            $rows[] = [
                'Plan' => $ratingPlanGroupName,
                'Call date' => $callDate->format('Y-m-d H:i:s'),
                'Duration' => $response->getCallDuration() . ' ' . $this->_helper->translate('seconds'),
                'Pattern Name' => $response->getPatternName() . ' (' . $response->getPrefix() . ')',
                'Con. Charge' => $response->getConnectionFee() . " $currencySymbol",
                'Interval start' => $response->getIntervalStart(),
                'Rate' => $rate,
                'Total cost' => "$cost $currencySymbol",
            ];
        }


        $info = $this->_drawTable(
            $headers,
            $rows,
            $this->getParam('number')
        );

        return $info;
    }

    protected function _drawTable($fieldNames, $array, $dest = null, $duration = null)
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

    protected function _showDialog(
        $title = "Title",
        $message = "Message",
        $ok = "Ok",
        $close = "Close",
        $reloadParent = false,
        $width = "1000",
        $height = "auto"
    ) {
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

    protected function _dispatch(array $data)
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

            try {
                $rerateService->execute($pks);
            } catch (\Exception $e) {
                $close = $this->_helper->translate('Close');

                $phpSettings = $this->getInvokeArg('bootstrap')->getOption("phpSettings");
                $displayErrors = $phpSettings["display_errors"] ?? false;
                $showErrors = ($e instanceof \DomainException) || $displayErrors;
                $message = $showErrors
                    ? $e->getMessage()
                    : 'undefined error';

                $data = array(
                    'error' => true,
                    'message'=> $this->_helper->translate($message),
                    'buttons' => array(
                        $close => array(
                            "recall" => false,
                            "reloadParent" => false
                        )
                    )
                );

                return $this->_dispatch($data);
            }

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
    private function simulateCallByRatingPlan($callDuration, $tenant, $ratingPlanTag)
    {
        $container = \Zend_Registry::get('container');

        /** @var CompanyBillingService $billingService */
        $billingService = $container->get(BillingService::class);

        return $billingService->simulateCallByRatingPlan(
            $tenant,
            $ratingPlanTag,
            $this->getParam('number'),
            $callDuration
        );
    }
}
