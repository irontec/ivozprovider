<?php

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
            ->addActionContext("tarificate-call", "json")
            ->addActionContext("test-tarificate-call", "json")
            ->addActionContext("tarification-info", "json")
            ->addActionContext("find-plan", "json")
            ->initContext("json");

        $this->_helper->layout->disableLayout();

        $auth = Zend_Auth::getInstance();
        if (! $auth->hasIdentity()) {
            // TODO Exceptionante
            throw new Klear_Exception_Default("No brand emulated");
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
                $companyId = $this->getParam("parentId");
                $call = new \IvozProvider\Model\ParsedCDRs();
                $call
                    ->setDst($this->getParam("number"))
                    ->setDstDuration($this->getParam("duration"))
                    ->setBrandId($this->_brandId)
                    ->setCompanyId($companyId)
                    ->setCalldate(new \Zend_Date());
                $result = $call->tarificate();
                if (is_null($result)) {
                    $this->_helper->log("[Tarificator] Result: null");
                } else {
                    $this->_helper->log("[Tarificator] Result: Not null");
                }
                $message = $this->_getTarificationInfo($call, "No plan matched");
                $title = $this->_helper->translate("Results");
                $this->_showDialog($title, $message, false, "Close", false, "auto");
            }

        } else {
            $this->_confirmDialog();
        }
    }

    public function tarificateCallAction ()
    {
        $pks = $this->getRequest()->getParam("pk");
        if (!is_array($pks) && !is_null($pks)) {
            $pks = array($pks);
        }

        if ($this->getParam("tarificate")) {
            $tarificatorJob = new \IvozProvider\Gearmand\Jobs\Tarificator();
            $tarificatorJob->setPks($pks);
            $tarificatorJob->send();
            $message = "<p>Tarificator Job started</p>";
            $title = $this->_helper->translate("OK");
            $this->_showDialog($title, $message, false, "Ok", false, "300", "100");
        } else {
            if (empty($pks)) {
                $this->_helper->log("[Tarificator] Tarificate all calls?");
                $messageContent = "Do you want to tarificate all calls?";
            } else {
                $this->_helper->log("[Tarificator] Tarificate selected calls?");
                $messageContent = "Do you want to tarificate selected calls?";
            }
            $title = $this->_helper->translate("Tarificate Calls?");
            $message = "<p>".$this->_helper->translate($messageContent)."</p>";
            $this->_showDialog($title, $message, "Ok", "Cancel", false, "300", "100");
        }
    }

    public function testTarificateCallAction ()
    {
        $pk = $this->getRequest()->getParam("pk");

        $callsMapper = new \IvozProvider\Mapper\Sql\ParsedCDRs();
        $this->_helper->log("[Tarificator] Tarificating call with id = ".$pk);
        $call = $callsMapper->find($pk);
        $call->tarificate();

        $message = $this->_getTarificationInfo($call, "Unable to tarificate");
        $title = $this->_helper->translate("Results");
        $this->_showDialog($title, $message, false, "Close", false, "auto");
        return;

    }

    public function tarificationInfoAction ()
    {
        $pk = $this->getRequest()->getParam("pk");
        $callsMapper = new \IvozProvider\Mapper\Sql\ParsedCDRs();
        $call = $callsMapper->find($pk);
        $message = $this->_getTarificationInfo($call);
        $message .= "<br />";
        $title = $this->_helper->translate("Info");
        $this->_showDialog($title, $message, false, "Close", false, "auto");
    }

    public function findPlanAction ()
    {
        if ($this->getParam("tarificate")) {
            $errors = $this->_getFormErrors();
            if (!is_null($errors)) {
                $this->_confirmDialog($errors);
            } else {
                $this->_findPlan();
            }

        } else {
            $this->_confirmDialog();
        }
    }

    protected function _findPlan ()
    {

        $dst = $this->getParam("number");
        $duration = $this->getParam("duration");

        $plansMapper = new \IvozProvider\Mapper\Sql\PricingPlans();
        $plans = $plansMapper->findByField("brandId", $this->_brandId);

        $table = array();
        foreach ($plans as $planToApply) {
            $matchedPrices = $planToApply->getMatchedPrices($dst);
            if (is_null($matchedPrices)) {
                continue;
            }
            $priceToApply = $matchedPrices[0];
            $matchedPattern = $priceToApply->getTargetPattern();
            $cost = $priceToApply->getCost($duration);
            $table[] = array(
                    "Plan" => $planToApply->getName(),
                    "Pattern" => $matchedPattern->getName(),
                    "Con. charge (€)" => $priceToApply->getConnectionCharge(),
                    "Period time (s)" => $priceToApply->getPeriodTime(),
                    "Per Period charge (€)" => $priceToApply->getPerPeriodCharge(),
                    "Metric" => $priceToApply->getMetric(),
                    "Cost" => $cost
            );
        }

        if (empty($table)) {
            $message = $title = $this->_helper->translate("No Plan found");
            $width = "auto";
        } else {
            $table = $this->_order($table, "Cost", "asc");
            $message = $this->_drawTable($table, $dst, $duration);
            $width = "1000";
        }
        $title = $this->_helper->translate("Results");
        $this->_showDialog($title, $message, false, "Close", false, $width);

    }


    protected function _order($array, $key, $type = null)
    {

        $tempArray = array();
        foreach ($array as $subArray) {
            $tempArray[] = array("subArray" => $subArray, "key" => $subArray[$key]);
        }
        if ($type == "asc") {
            usort($tempArray, function($a, $b) {
                if (doubleval($a['key']) < doubleval($b['key'])) {
                    return -1;
                }
                if (doubleval($a['key']) > doubleval($b['key'])) {
                    return 1;
                }
                return 0;
            });
        }

        if ($type == "desc") {
            usort($tempArray, function($a, $b) {
                if (doubleval($a['key']) < doubleval($b['key'])) {
                    return 1;
                }
                if (doubleval($a['key']) > doubleval($b['key'])) {
                    return -1;
                }
                return 0;
            });
        }

        $orderedArray = array();
        foreach ($tempArray as $tempValues) {
            $orderedArray[] = $tempValues["subArray"];
        }
        return $orderedArray;
    }

    protected function _confirmDialog ($errorMessage = "")
    {
        $title = $this->_helper->translate("Pricing Plans Tester");
        $message = $errorMessage;
        $message .= "<table class='kMatrix'>";
        $message .=     "<tr>";
        $message .=         "<th class='ui-widget-header multiItem notSortable'>";
        $message .=             $this->_helper->translate("Phone number");
        $message .=         "</th>";
        $message .=         "<th class='ui-widget-header multiItem notSortable'>";
        $message .=             $this->_helper->translate("Duration (s)");
        $message .=         "</th>";
        $message .=     "</tr>";
        $message .=     "<tr>";
        $message .=         "<td class='ui-widget-content'>";
        $message .=             '<input type="number" name="number" class="ui-widget ui-state-default ui-corner-all"';
        $message .=                 ' value="'.$this->getParam("number").'">';
        $message .=         "</td>";
        $message .=         "<td class='ui-widget-content'>";
        $message .=             '<input type="number" name="duration" class="ui-widget ui-state-default ui-corner-all"';
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

    protected function _getTarificationInfo(\IvozProvider\Model\ParsedCDRs $call, $errorMessage = "No tarification info found")
    {
        $jsonData = $call->getPricingPlanDetails();
        if (is_null($jsonData)) {
            $info = $this->_helper->translate($errorMessage);
        } else {
            $meteringDate = $call->getMeteringDate(true);
            $meteringDate->setTimezone(date_default_timezone_get());
            $data = json_decode($jsonData, true);
//             var_dump($data); die();
            $table = array(
                    array(
                            "Call date" => $call->getCalldate(true)->setTimezone(date_default_timezone_get()),
                            "Metering date" => $meteringDate->toString(),
                            "Company" => $data["Company"]["name"],
                            "Plan" => $data["Plan"]["name"],
                            "Plan Metric" => $data["CompanyPlan"]["metric"],
                            "Valid from" => $data["CompanyPlan"]["validFrom"],
                            "Valid to" => $data["CompanyPlan"]["validTo"],
                            "Pattern Name" => $data["Pattern"]["name"],
                            "RegExp" => $data["Pattern"]["regExp"],
                            "Metric" => $data["Price"]["metric"],
                            "Con. Charge" => $data["Price"]["connectionCharge"],
                            "Period Time" => $data["Price"]["periodTime"],
                            "Per Period Charge" => $data["Price"]["perPeriodCharge"],
                            "Cost" => $data["Cost"],
                    )
            );

            $info = $this->_drawTable($table, $call->getDst(), $call->getDstDuration());
        }

        return $info;
    }

    protected function _drawTable($array, $dest=null, $duration = null)
    {
        $fieldNames = array_keys($array[0]);

        $table = "<table class='kMatrix'>";
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
                $table .= "<td class='ui-widget-content tarificator' style='width: 10%;'>";
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

