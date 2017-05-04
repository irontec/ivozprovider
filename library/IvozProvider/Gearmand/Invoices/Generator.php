<?php
namespace IvozProvider\Gearmand\Invoices;

class Generator
{

    protected $_invoiceId = null;
    protected $_logger = null;
    protected $_fixedCostTotal = 0;
    protected $_fixedCosts = array();
    protected $_totals = array();

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
        $pdfContents = $this->_createInvoice();

        return $pdfContents;
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

        $dateFormat = \Zend_Locale_Format::getDateFormat($invoice->getCompany()->getLanguageCode());
        $invoiceTz = $company->getDefaultTimezone()->getTz();
        $invoiceDate = new \Zend_Date();
        $invoiceDate->setTimezone($invoiceTz);

        $inDate = $invoice->getInDate(true);
        $inDate->setTimezone($invoiceTz);
        $outDate = $invoice->getOutDate(true);
        $outDate->setTimezone($invoiceTz);
        $outDate->addDay(1)->subSecond(1);

        $engine = 'pdf';
        $facade = \PHPPdf\Core\FacadeBuilder::create()
        ->setEngineType($engine)
        ->setEngineOptions(
            array(
                'format' => 'jpg',
                'quality' => 70,
                'engine' => 'imagick',
            )
        )
        ->build();

        $invoiceArray = $invoice->toArray();
        $invoiceArray["invoiceDate"] = $invoiceDate->toString($dateFormat);
        $invoiceArray["inDate"] = $inDate->toString($dateFormat);
        $invoiceArray["outDate"] = $outDate->toString($dateFormat);
        $brandArray = $brand->toArray();
        $brandArray["logoPath"] = $brandLogoPath;

        $variables = array(
                "invoice" => $invoiceArray,
                "company" => $company->toArray(),
                "brand" => $brandArray,
                "callData" => $callData,
                "fixedCosts" => array($this->_fixedCosts),
                "fixedCostsTotals" => $this->_fixedCostTotal,
                "totals" => $this->_totals
        );
        $templateModel = $invoice->getInvoiceTemplate();
        if (!$templateModel) {
            throw new \Exception("No template assigned.");
        }
        $template = $templateModel->getTemplate();
        $xml = \IvozProvider\Template\Formatter::format($template, $variables);
        $content = $facade->render($xml);
        return $content;
    }

    protected function _getCallData(\IvozProvider\Model\Invoices $invoice)
    {
        $brand = $invoice->getBrand();
        $company =$invoice->getCompany();
        $invoiceTz = $company->getDefaultTimezone()->getTz();
        $inDate = $invoice->getInDate(true);
        $inDate->setTimezone($invoiceTz);
        $outDate = $invoice->getOutDate(true);
        $outDate->setTimezone($invoiceTz);
        $outDate->addDay(1)->subSecond(1);

        $callsMapper = new \IvozProvider\Mapper\Sql\KamAccCdrs();
        $limit = 50;
        $offset = 0;
        $continue = true;
        $wheres = array(
                "brandId = '".$brand->getPrimaryKey()."'",
                "companyId = '".$company->getPrimaryKey()."'",
                "metered = 1 ",
                "peeringContractId IS NOT NULL",
                "peeringContractId != ''",
                "start_time_utc >= '".$inDate->toString('yyyy-MM-dd HH:mm:ss')."'",
                "start_time_utc <= '".$outDate->toString('yyyy-MM-dd HH:mm:ss')."'"
        );
        $where = implode(" AND ", $wheres);
        $this->_log("[INVOICE GENERATOR] Where: ".$where, \Zend_Log::DEBUG);
        $order = "start_time_utc asc";

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
                "cost" => number_format(ceil($cost*10000)/10000, 4),
                "subTotal" => number_format(ceil($subTotal*10000)/10000, 4)
            );
            $this->_fixedCostTotal  += number_format(ceil($subTotal*10000)/10000, 4);
        }
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
                if (!$call) {
                    $call = new \IvozProvider\Model\KamAccCdrs();
                }

                $lang = $invoice->getCompany()->getLanguageCode();
                $callData = $call->toArray();
                $callData["calldate"] = $call->getStartTimeUtc(true)->setTimezone($invoiceTz)->toString();
                $callData["dst"] = $call->getCallee();
                $callData["price"] = number_format(ceil($callData["price"]*10000)/10000, 4);
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
                    $callData["pricingPlan"] = $call->getPricingPlan()->toArray();
                    $callData["pricingPlan"]["description"] = $call->getPricingPlan()->getDescription($lang);
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
                        $callsPerType[$callType] = array();
                    }
                    $callsPerType[$callType][] = $callData;
                }
                if ($call->getDirection() == "inbound") {
                    $inboundCalls["summary"]["numberOfCalls"] += 1;
                    $inboundCalls["summary"]["totalCallsDuration"] += $call->getDuration();
                    $inboundCalls["summary"]["totalCallsDurationFormatted"] = $this->_timeFormat($inboundCalls["summary"]["totalCallsDuration"]);
                    $inboundCalls["summary"]["totalPrice"] += number_format(ceil($callData["price"]*10000)/10000, 4);
                } else {
                    $callSumary[$callType]["numberOfCalls"] += 1;
                    $callSumary[$callType]["totalCallsDuration"] += $call->getDuration();
                    $callSumary[$callType]["totalCallsDurationFormatted"] = $this->_timeFormat($callSumary[$callType]["totalCallsDuration"]);
                    $callSumary[$callType]["totalPrice"] += number_format(ceil($callData["price"]*10000)/10000, 4);
                }
                $callSumaryTotals["numberOfCalls"] += 1;
                $callSumaryTotals["totalCallsDuration"] += $call->getDuration();
                $callSumaryTotals["totalCallsDurationFormatted"] = $this->_timeFormat($callSumaryTotals["totalCallsDuration"]);
                $callSumaryTotals["totalPrice"] += number_format(ceil($callData["price"]*10000)/10000, 4);

                $call->setInvoice($invoice)->save();

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


        $this->_log("[Invoices][Generator] Saving TotalPrice and Total price with taxes", \Zend_Log::INFO);
        $this->_log("[Invoices][Generator] TotalPrice: ".$total, \Zend_Log::INFO);
        $this->_log("[Invoices][Generator] Total price with taxes: ".$totalWithTaxex, \Zend_Log::INFO);

        asort($callSumary);
        asort($callsPerType);
        $finalData= array(
                "callSumary" => $callSumary,
                "callsPerType" => $callsPerType,
                "callSumaryTotals" => $callSumaryTotals,
                "inboundCalls" => $inboundCalls,
        );

        return $finalData;
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

        $this->_logger->log($message, $priority);
    }
}
