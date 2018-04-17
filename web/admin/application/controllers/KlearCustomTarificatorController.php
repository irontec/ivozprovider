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
            ->initContext("json");

        $this->_helper->layout->disableLayout();

        $auth = Zend_Auth::getInstance();
        if (!$auth->hasIdentity()) {
            throw new \Klear_Exception_Default("No brand emulated");
        }
        $loggedUser = $auth->getIdentity();
        $this->_brandId = $loggedUser->brandId;
    }

    public function testCompanyPlansAction ()
    {
        if ($this->getParam("tarificate")) {
            $errors = $this->_getFormErrors();
            if (!is_null($errors)) {
                $this->_confirmDialog($errors);
            } else {

                $container = \Zend_Registry::get('container');

                /** @var DataGateway $dataGateway */
                $dataGateway = $container->get(DataGateway::class);

                /** @var CompanyBillingService $billingService */
                $billingService = $container->get(BillingService::class);

                /** @var \Ivoz\Provider\Domain\Model\Company\CompanyDto $companyDto */
                $companyDto = $dataGateway->find(
                    \Ivoz\Provider\Domain\Model\Company\Company::class,
                    $this->getParam("parentId")
                );

                $callDuration = $this->getParam('duration');
                $callDuration = max(1, $callDuration);

                try {
                    $response = $billingService->simulateCall(
                        'b' . $companyDto->getBrandId(),
                        'c' . $companyDto->getId(),
                        $this->getParam('number'),
                        $callDuration
                    );

                    $message = $this->_getTarificationInfo($response);

                } catch (\Exception $e) {

                    $message = $e->getMessage();
                    if ($message === 'SERVER_ERROR: UNAUTHORIZED_DESTINATION') {

                        $message = $this->_helper->translate(
                            'Active pricing plan does not allow to call introduced phone number'
                        );
                    }
                    $this->_helper->log("[Tarificator] Result: error " . $message);
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

        } else {
            $this->_confirmDialog();
        }
    }


    protected function _confirmDialog ($errorMessage = "")
    {
        $title = $this->_helper->translate("Rating Profile Tester");
        $message = $errorMessage;
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
        $message .=             '<input type="text" name="number" placeholder="+34123456789" class="ui-widget ui-state-default ui-corner-all"';
        $message .=                 ' value="'.$this->getParam("number").'">';
        $message .=         "</td>";
        $message .=         "<td class='ui-widget-content'>";
        $message .=             '<input type="number" name="duration" value="60" min="1" placeholder="value in seconds" class="ui-widget ui-state-default ui-corner-all"';
        $message .=                 ' value="'.$this->getParam("duration").'">';
        $message .=         "</td>";
        $message .=     "</tr>";
        $message .= "</table>";

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

    protected function _getTarificationInfo(SimulatedCall $response)
    {
        $ratingPlanName = $response->getRatingPlan()->getNameEn();
        $chargePeriod = $response->getChargePeriod();
        $rate = $response->getRate();
        $cost = $response->getCost() + $response->getConnectionFee();

        $table = [
            "Call date" => $response->getCallDate()->format('Y-m-d H:i:s'),
            "Duration" => $response->getCallDuration() . ' ' . $this->_helper->translate('seconds'),
            "Plan" => $ratingPlanName,
            "Pattern Name" => $response->getPatternName() . ' (' . $response->getPrefix() . ')',
            "Con. Charge" => $response->getConnectionFee(),
            "Rate" => $rate . ' / ' . $chargePeriod . ' ' . $this->_helper->translate('seconds'),
            "Total cost" => $cost,
        ];

        $info = $this->_drawTable(
            [$table],
            $this->getParam("number")
        );

        return $info;
    }

    protected function _drawTable($array, $dest=null, $duration = null)
    {
        $fieldNames = array_keys($array[0]);

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
            foreach ($row as $field) {
                $table .= "<td class='ui-widget-content tarificator' style='width: 10%; text-align: center;'>";
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
        $jsonResponse->setModule('klearMatrix');
        $jsonResponse->setPlugin('klearMatrixGenericDialog');
        $jsonResponse->addJsFile(
            '/js/plugins/jquery.klearmatrix.genericdialog.js');
        $jsonResponse->setData($data);
        $jsonResponse->attachView($this->view);
    }
}
