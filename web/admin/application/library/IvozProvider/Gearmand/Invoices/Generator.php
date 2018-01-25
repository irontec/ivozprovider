<?php
namespace IvozProvider\Gearmand\Invoices;

use Knp\Snappy\Pdf;
use Handlebars\Handlebars;

class Generator
{
    const DATE_FORMAT = 'dd-MM-yyyy';
    const DATE_TIME_FORMAT = 'dd-MM-yyyy HH:mm:ss';
    const MYSQL_DATETIME_FORMAT = 'yyyy-MM-dd HH:mm:ss';

    protected $_invoiceId = null;
    protected $_logger = null;
    protected $_fixedCostTotal = 0;
    protected $_fixedCosts = array();
    protected $_totals = array();

    protected $pricingPlanCache = [];

    const LOGGER_PREFIX = "[Invoices][Generator]";

    public function __construct($invoiceId = null, $logger = null)
    {
        if (!is_null($invoiceId)) {
            $this->_invoiceId = $invoiceId;
        }

        if (!is_null($logger)) {
            $this->_logger = $logger;
        }
    }

    public function setInvoiceId($id)
    {
        $this->_invoiceId = $id;
        return $this;
    }

    public function setLogger($logger)
    {
        $this->_logger = $logger;
        return $this;
    }

    public function getTotals()
    {
        return $this->_totals;
    }

    public function getInvoicePDFContents()
    {
        return $this->_createInvoice();
    }

    protected function _createInvoice()
    {
        $invoicesMapper = new \IvozProvider\Mapper\Sql\Invoices();
        $invoice = $invoicesMapper->find($this->_invoiceId);

        $callData = $this->_getCallData($invoice);

        $brand = $invoice->getBrand();
        $company = $invoice->getCompany();

        $brandLogoPath = $brand->fetchLogo()->getFilePath();

        if (!file_exists($brandLogoPath)) {
            $brandLogoPath = "images/palmera90.png";
        }

        $invoiceTz = $company->getDefaultTimezone()->getTz();
        $invoiceDate = new \Zend_Date();
        $invoiceDate->setTimezone($invoiceTz);

        $inDate = $invoice->getInDate(true);
        $inDate->setTimezone($invoiceTz);
        $outDate = $invoice->getOutDate(true);
        $outDate->setTimezone($invoiceTz);
        $outDate->addDay(1)->subSecond(1);

        $invoiceArray = $invoice->toArray();
        $invoiceArray["invoiceDate"] = $invoiceDate->toString(self::DATE_FORMAT);
        $invoiceArray["inDate"] = $inDate->toString(self::DATE_FORMAT);
        $invoiceArray["outDate"] = $outDate->toString(self::DATE_FORMAT);
        $brandArray = $brand->toArray();
        $brandArray["logoPath"] = $brandLogoPath;

        $variables = array(
            "invoice" => $invoiceArray,
            "company" => $company->toArray(),
            "brand" => $brandArray,
            "callData" => $callData,
            "fixedCosts" => $this->_fixedCosts,
            "fixedCostsTotals" => $this->_fixedCostTotal,
            "totals" => $this->_totals
        );

        /**
         * @var $templateModel \IvozProvider\Model\InvoiceTemplates
         */
        $templateModel = $invoice->getInvoiceTemplate();
        if (!$templateModel) {
            throw new \Exception("No template assigned.");
        }

        $this->_log("Preparing templates", \Zend_Log::DEBUG);
        $templateEngine = new Handlebars;;
        $header = $templateEngine->render($templateModel->getTemplateHeader(), $variables);
        $body = $templateEngine->render($templateModel->getTemplate(), $variables);
        $footer = $templateEngine->render($templateModel->getTemplateFooter(), $variables);

        $this->_log("Rendering the PDF", \Zend_Log::DEBUG);
        $architecture = (php_uname("m") === 'x86_64') ? 'amd64' : 'i386';

        $snappy = new Pdf(APPLICATION_PATH . '/../../library/vendor/bin/wkhtmltopdf-' . $architecture);
        $snappy->setTimeout(60 * 10);
        $snappy->setOption('header-html', $header);
        $snappy->setOption('header-spacing', 3);
        $snappy->setOption('footer-html', $footer);
        $snappy->setOption('footer-spacing', 3);
        $content = $snappy->getOutputFromHtml($body);
        $snappy->removeTemporaryFiles();

        return $content;
    }

    protected function _getCallData(\IvozProvider\Model\Invoices $invoice)
    {
        $brand = $invoice->getBrand();
        $company = $invoice->getCompany();
        $lang = $company->getLanguageCode();
        $invoiceTz = $company->getDefaultTimezone()->getTz();
        $inDate = $invoice->getInDate(true);
        $inDate->setTimezone($invoiceTz);
        $outDate = $invoice->getOutDate(true);
        $outDate->setTimezone($invoiceTz);
        $outDate->addDay(1)->subSecond(1);

        $callsMapper = new \IvozProvider\Mapper\Sql\KamAccCdrs();

        $callsPerType = array();
        $callSumary = array();
        $callSumaryTotals = array(
            "numberOfCalls" => 0,
            "totalCallsDuration" => 0,
            "totalCallsDurationFormatted" => $this->_timeFormat(0),
            "totalPrice" => 0
        );
        $inboundCalls = array();

        $this->_fixedCostTotal = 0;
        $fixedCostsRelInvoices = $invoice->getFixedCostsRelInvoices();

        foreach ($fixedCostsRelInvoices as $key => $fixedCostsRelInvoice) {
            $cost = $fixedCostsRelInvoice->getFixedCost()->getCost();
            $quantity = $fixedCostsRelInvoice->getQuantity();
            $subTotal = $cost * $quantity;
            $this->_fixedCosts[] = array(
                "quantity" => $quantity,
                "name" => $fixedCostsRelInvoice->getFixedCost()->getName(),
                "description" => $fixedCostsRelInvoice->getFixedCost()->getDescription(),
                "cost" => $this->roundAndFormat($cost),
                "subTotal" => $this->roundAndFormat($subTotal)
            );
            $this->_fixedCostTotal += $this->roundAndFormat($subTotal);
        }

        $wheres = array(
            "brandId = '".$brand->getPrimaryKey()."'",
            "companyId = '".$company->getPrimaryKey()."'",
            "metered = 1 ",
            "peeringContractId IS NOT NULL",
            "peeringContractId != ''",
            "start_time >= '".$inDate->toString(self::MYSQL_DATETIME_FORMAT)."'",
            "start_time <= '".$outDate->toString(self::MYSQL_DATETIME_FORMAT)."'"
        );

        $where = implode(" AND ", $wheres);
        $order = "start_time asc";
        $limit = 100;
        $offset = 0;
        $continue = true;

        $this->_log("Where: ".$where, \Zend_Log::DEBUG);

        $dbAdapter = $invoice->getMapper()->getDbTable()->getAdapter();
        $updateCallsInvoiceId = 'UPDATE `kam_acc_cdrs` SET `invoiceId` = ' . $invoice->getId();
        $updateCallsInvoiceId .= ' WHERE ' . $where;
        $dbAdapter->query($updateCallsInvoiceId);

        while ($continue) {

            $calls = $callsMapper->fetchList($where, $order, $limit, $offset);
            if (count($calls) < $limit) {
                $continue = false;
            }
            if (empty($calls)) {
                break;
            }
            $offset += $limit;

            foreach ($calls as $call) {

                $callData = $call->toArray();
                $callData["calldate"] = $call->getStartTime(true)->setTimezone($invoiceTz)->toString(self::DATE_TIME_FORMAT);
                $callData["dst"] = $call->getCallee();
                $callData["price"] = $this->roundAndFormat($callData["price"]);

                $callData["dst_duration_formatted"] = $this->_timeFormat($callData["duration"]);
                $callData["durationFormatted"] = $this->_timeFormat($callData["duration"]);

                $callData["targetPattern"] = array();
                if ($call->getTargetPatternId()) {
                    $callData["targetPattern"] = $call->getTargetPattern()->toArray();
                    $callData["targetPattern"]["description"] = $call->getTargetPattern()->getDescription($lang);
                }
                $callData["targetPattern"]["name"] = $call->getTargetPatternName();

                $callData["pricingPlan"] = array();
                if ($call->getPricingPlanId()) {
                    $pricingPlan = $this->getCallPricingPlan($call);
                    $callData["pricingPlan"] = $pricingPlan->toArray();
                    $callData["pricingPlan"]["description"] = $pricingPlan->getDescription($lang);
                }
                $callData["pricingPlan"]["name"] = $call->getPricingPlanName();

                $callType = md5($callData["targetPattern"]["name"]);
                if ($call->getDirection() == "inbound") {
                    if (!isset($inboundCalls["summary"])) {
                        $inboundCalls["summary"] = array(
                            "numberOfCalls" => 0,
                            "totalCallsDuration" => 0,
                            "totalPrice" => 0
                        );
                    }

                } else {
                    if (!isset($callSumary[$callType])) {
                        $callSumary[$callType] = array(
                            "type" => $callData["targetPattern"]["name"],
                            "numberOfCalls" => 0,
                            "totalCallsDuration" => 0,
                            "totalPrice" => 0
                        );
                    }
                }
                if ($call->getDirection() == "inbound") {
                    $inboundCalls["calls"][] = $callData;
                } else {
                    if (!isset($callsPerType[$callType])) {
                        $callsPerType[$callType] = array('items' => []);
                    }
                    $callsPerType[$callType]['items'][] = $callData;
                }
                if ($call->getDirection() == "inbound") {
                    $inboundCalls["summary"]["numberOfCalls"] += 1;
                    $inboundCalls["summary"]["totalCallsDuration"] += $call->getDuration();
                    $inboundCalls["summary"]["totalCallsDurationFormatted"] = $this->_timeFormat($inboundCalls["summary"]["totalCallsDuration"]);
                    $inboundCalls["summary"]["totalPrice"] = $this->sumAndFormat($inboundCalls["summary"]["totalPrice"], $callData["price"]);

                } else {
                    $callSumary[$callType]["numberOfCalls"] += 1;
                    $callSumary[$callType]["totalCallsDuration"] += $call->getDuration();
                    $callSumary[$callType]["totalCallsDurationFormatted"] = $this->_timeFormat($callSumary[$callType]["totalCallsDuration"]);
                    $callSumary[$callType]["totalPrice"] = $this->sumAndFormat($callSumary[$callType]["totalPrice"], $callData["price"]);
                }

                $callSumaryTotals["numberOfCalls"] += 1;
                $callSumaryTotals["totalCallsDuration"] += $call->getDuration();
                $callSumaryTotals["totalCallsDurationFormatted"] = $this->_timeFormat($callSumaryTotals["totalCallsDuration"]);
                $callSumaryTotals["totalPrice"] = $this->sumAndFormat($callSumaryTotals["totalPrice"], $callData["price"]);
            }
        }

        $total = $callSumaryTotals["totalPrice"] + $this->_fixedCostTotal;
        $totalTaxex = ceil(($total*$invoice->getTaxRate()/100)*10000)/10000;
        $totalWithTaxex = ceil(($totalTaxex + $total)*100)/100;

        $this->_totals = array(
            "totalPrice" => $total,
            "totalTaxes" => $totalTaxex,
            "totalWithTaxes" => $totalWithTaxex
        );

        $this->_log("Saving TotalPrice and Total price with taxes", \Zend_Log::INFO);
        $this->_log("TotalPrice: " . $total, \Zend_Log::INFO);
        $this->_log("Total price with taxes: " . $totalWithTaxex, \Zend_Log::INFO);

        asort($callSumary);
        asort($callsPerType);
        $finalData = array(
            "callSumary" => array_values($callSumary),
            "callsPerType" => array_values($callsPerType),
            "callSumaryTotals" => $callSumaryTotals,
            "inboundCalls" => $inboundCalls,
        );

        return $finalData;
    }

    /**
     * @param string|number $value
     * @param string|number $value2
     * @return string
     */
    protected function sumAndFormat($value, $value2)
    {
        return $this->formatNumber(
            $this->sumConcepts($value, $value2)
        );
    }

    /**
     * @param string|number $value
     * @param string|number $value2
     * @return float
     */
    protected function sumConcepts($value, $value2)
    {
        if (!is_string($value)) {
            $value = $this->roundAndFormat($value);
        }

        if (!is_string($value2)) {
            $value2 = $this->roundAndFormat($value2);
        }

        // Sum Stringified floats to avoid issues with decimals
        return $value + $value2;
    }

    /**
     * @param string|number $value
     * @param int $decimals
     * @return string
     */
    protected function roundAndFormat($value, $decimals = 4)
    {
        return $this->formatNumber(
            $this->roundNumber($value, $decimals)
        );
    }

    /**
     * @param string|number $value
     * @param int $decimals
     * @return float
     */
    protected function roundNumber($value, $decimals = 4)
    {
        $decimals = pow(10, $decimals);
        return ceil(floatval($value) * $decimals) / $decimals;
    }

    /**
     * @param float $number
     * @return string
     */
    protected function formatNumber($number)
    {
        return number_format(
            $number,
            4,
            '.',
            ''
        );
    }

    protected function _timeFormat($seconds)
    {
        $hours = floor($seconds / 3600);
        $mins = floor($seconds / 60 % 60);
        $secs = floor($seconds % 60);
        return sprintf('%02d:%02d:%02d', $hours, $mins, $secs);
    }

    protected function _log($message, $priority)
    {
        if (is_null($this->_logger)) {
            return;
        }

        $this->_logger->log(self::LOGGER_PREFIX . " " . $message, $priority);
    }

    /**
     * @param $call
     * @return mixed
     */
    protected function getCallPricingPlan(\IvozProvider\Model\KamAccCdrs $call)
    {
        $pricingPlanId = $call->getPricingPlanId();
        if (!array_key_exists($pricingPlanId, $this->pricingPlanCache)) {
            $this->pricingPlanCache[$pricingPlanId] = $call->getPricingPlan();
        }

        return $this->pricingPlanCache[$pricingPlanId];
    }
}
