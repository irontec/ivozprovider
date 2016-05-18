<?php
namespace IvozProvider\Gearmand\Invoices;

class Generator
{

    protected $_invoiceId = null;
    protected $_logger = null;
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

        $footer = "Inforamción de la marca";

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

        $locale = $invoice->getCompany()->getLanguageCode();

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


        $callsMapper = new \IvozProvider\Mapper\Sql\ParsedCDRs();
        $limit = 50;
        $offset = 0;
        $continue = true;
        $wheres = array(
                "brandId = '".$brand->getPrimaryKey()."'",
                "companyId = '".$company->getPrimaryKey()."'",
                "metered = 1 ",
                "calldate >= '".$inDate->toString('yyyy-MM-dd HH:mm:ss')."'",
                "calldate <= '".$outDate->toString('yyyy-MM-dd HH:mm:ss')."'"
        );
        $where = implode(" AND ", $wheres);
        $this->_log("[INVOICE GENERATOR] Where: ".$where, \Zend_Log::DEBUG);
        $order = "calldate asc";

        $callsPerType = array();
        $callSumary = array();
        $callSumaryTotals = array(
                "numberOfCalls" => 0,
                "totalCallsDuration" => 0,
                "totalPrice" => 0
        );

        $fixedCosts = array();
        $fixedCostsRelInvoices = $invoice->getFixedCostsRelInvoices();
        foreach ($fixedCostsRelInvoices as $key => $fixedCostsRelInvoice) {
            $cost = $fixedCostsRelInvoice->getFixedCost()->getCost();
            $quantity = $fixedCostsRelInvoice->getQuantity();
            $subTotal = $cost * $quantity;
            $fixedCosts[] = array(
                "quantity" => $quantity,
                "description" => $fixedCostsRelInvoice->getFixedCost()->getDescription(),
                "cost" => number_format(ceil($cost*100)/100, 2),
                "subTotal" => number_format(ceil($subTotal*100)/100, 2)
            );
            $callSumaryTotals["totalPrice"] += number_format(ceil($subTotal*100)/100, 2);
        }
        $fixedCostTotal = $callSumaryTotals["totalPrice"];

        while ($continue) {
            $calls = $callsMapper->fetchList($where, $order, $limit, $offset);
            if (count($calls) < $limit) {
                $continue = false;
            }
            if (empty($calls)) {
                break;
            }
            foreach ($calls as $call) {
                $lang = $invoice->getCompany()->getLanguageCode();
                $callData = $call->toArray();
                $callData["calldate"] = $call->getCallDate(true)->setTimezone($invoiceTz)->toString();
                $callData["price"] = number_format(ceil($callData["price"]*100)/100, 2);
                $callData["dst_duration_formatted"] = gmdate("H:i:s", $callData["dst_duration"]);
                $callData["targetPattern"] = $call->getTargetPattern()->toArray();
                $callData["targetPattern"]["name"] = $call->getTargetPattern()->getName($lang);
                $callData["targetPattern"]["description"] = $call->getTargetPattern()->getDescription($lang);
                $callData["pricingPlan"] = $call->getPricingPlan()->toArray();
                $callData["pricingPlan"]["name"] = $call->getPricingPlan()->getName($lang);
                $callData["pricingPlan"]["description"] = $call->getPricingPlan()->getDescription($lang);
                $callType = md5($call->getTargetPattern()->getName());
                if (!isset($callSumary[$callType])) {
                    $callSumary[$callType] = array(
                            "type" => $callData["targetPattern"]["name"],
                            "numberOfCalls" => 0,
                            "totalCallsDuration" => 0,
                            "totalPrice" => 0
                    );
                }
                if (!isset($callsPerType[$callType])) {
                    $callsPerType[$callType] = array();
                }
                $callsPerType[$callType][] = $callData;
                $callSumary[$callType]["numberOfCalls"] += 1;
                $callSumary[$callType]["totalCallsDuration"] += $call->getDstDuration();
                $callSumary[$callType]["totalCallsDurationFormatted"] = gmdate("H:i:s", $callSumary[$callType]["totalCallsDuration"]);
                $callSumary[$callType]["totalPrice"] += number_format(ceil($callData["price"]*100)/100, 2);
                $callSumaryTotals["numberOfCalls"] += 1;
                $callSumaryTotals["totalCallsDuration"] += $call->getDstDuration();
                $callSumaryTotals["totalCallsDurationFormatted"] = gmdate("H:i:s", $callSumaryTotals["totalCallsDuration"]);
                $callSumaryTotals["totalPrice"] += number_format(ceil($callData["price"]*100)/100, 3);

                $call->setInvoice($invoice)->save();
            }
        }

        $callSumaryTotals["totalTaxes"] = number_format(ceil($callSumaryTotals["totalPrice"]*$invoice->getTaxRate())/100, 2);
        $callSumaryTotals["totalWithTaxes"] = number_format($callSumaryTotals["totalTaxes"]+$callSumaryTotals["totalPrice"], 2);

        $this->_log("[Invoices][Generator] Saving TotalPrice and Total price with taxes", \Zend_Log::INFO);
        $this->_log("[Invoices][Generator] TotalPrice: ".$callSumaryTotals["totalPrice"], \Zend_Log::INFO);
        $this->_log("[Invoices][Generator] Total price with taxes: ".$callSumaryTotals["totalWithTaxes"], \Zend_Log::INFO);

        $this->_totals["totalPrice"] =  $callSumaryTotals["totalPrice"];
        $this->_totals["totalWithTaxes"] =  $callSumaryTotals["totalWithTaxes"];

        return array(
                "callSumary" => $callSumary,
                "callsPerType" => $callsPerType,
                "callSumaryTotals" => $callSumaryTotals,
                "fixedCosts" => array($fixedCosts),
                "fixedCoststotals" => $fixedCostTotal,
        );
    }

    protected function _log($message, $priority)
    {
        if (is_null($this->_logger)) {
            return;
        }

        $this->_logger->log($message, $priority);
    }
}