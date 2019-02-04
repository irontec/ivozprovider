<?php

namespace Ivoz\Provider\Domain\Service\Invoice;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\BillableCall\BillableCallInterface;
use Ivoz\Provider\Domain\Model\BillableCall\BillableCallRepository;
use Ivoz\Provider\Domain\Model\Destination\DestinationDto;
use Ivoz\Provider\Domain\Model\Invoice\InvoiceInterface;
use Ivoz\Provider\Domain\Model\Invoice\InvoiceRepository;
use Ivoz\Provider\Domain\Model\InvoiceTemplate\InvoiceTemplate;
use Ivoz\Provider\Domain\Model\RatingPlanGroup\RatingPlanGroupDto;
use Knp\Snappy\Pdf;
use Handlebars\Handlebars;
use Monolog\Logger;

class Generator
{
    const DATE_FORMAT = 'd-m-Y';
    const DATE_TIME_FORMAT = 'd-m-Y H:i:s';
    const MYSQL_DATETIME_FORMAT = 'Y-m-d H:i:s';

    const LOGGER_PREFIX = '[Invoices][Generator]';

    protected $invoiceId = null;
    protected $fixedCostTotal = 0;
    protected $fixedCosts = array();
    protected $totals = array();
    protected $pricingPlanCache = [];

    /**
     * @var InvoiceRepository
     */
    protected $invoiceRepository;

    /**
     * @var BillableCallRepository
     */
    protected $billableCallRepository;

    /**
     * @var EntityTools
     */
    protected $entityTools;

    /**
     * @var Logger
     */
    protected $logger;

    /**
     * @var string
     */
    protected $vendorDir;

    /**
     * Generator constructor.
     *
     * @param InvoiceRepository $invoiceRepository
     * @param BillableCallRepository $billableCallRepository
     * @param EntityTools $entityTools
     * @param Logger $logger
     * @param string $vendorDir
     */
    public function __construct(
        InvoiceRepository $invoiceRepository,
        BillableCallRepository $billableCallRepository,
        EntityTools $entityTools,
        Logger $logger,
        string $vendorDir
    ) {
        $this->invoiceRepository = $invoiceRepository;
        $this->billableCallRepository = $billableCallRepository;
        $this->entityTools = $entityTools;
        $this->logger = $logger;
        $this->vendorDir = $vendorDir;
    }

    public function setInvoiceId($id)
    {
        $this->invoiceId = $id;
        return $this;
    }

    public function getTotals()
    {
        return $this->totals;
    }

    /**
     * @param int $invoiceId
     * @return string
     * @throws \Exception
     */
    public function getInvoicePDFContents(int $invoiceId)
    {
        $this->setInvoiceId($invoiceId);
        return $this->_createInvoice();
    }

    protected function _createInvoice()
    {
        /** @var InvoiceInterface $invoice */
        $invoice = $this->invoiceRepository->find($this->invoiceId);

        $callData = $this->_getCallData($invoice);

        $brand = $invoice->getBrand();
        $brandDto = $this->entityTools->entityToDto($brand);
        $brandLogoPath = $brandDto->getLogoPath();
        if (!file_exists($brandLogoPath)) {
            $brandLogoPath = 'images/palmera90.png';
        }

        $company = $invoice->getCompany();
        $companyDto = $this->entityTools->entityToDto($company);
        $invoiceTz = new \DateTimeZone(
            $company->getDefaultTimezone()->getTz()
        );

        $currencySymbol = $company->getCurrencySymbol();

        $invoiceDate = new \DateTime();
        $invoiceDate->setTimezone($invoiceTz);

        $inDate = $invoice->getInDate();
        $inDate->setTimezone($invoiceTz);

        $outDate = $invoice->getOutDate();
        $outDate->setTimezone($invoiceTz);

        $invoiceDto = $this->entityTools->entityToDto($invoice);

        $invoiceArray = $invoiceDto->toArray();
        $invoiceArray['invoiceDate'] = $invoiceDate->format(self::DATE_FORMAT);
        $invoiceArray['currency'] = $currencySymbol;
        $invoiceArray['inDate'] = $inDate->format(self::DATE_FORMAT);
        $invoiceArray['outDate'] = $outDate->format(self::DATE_FORMAT);
        $brandArray = $brandDto->toArray();
        $brandArray['logoPath'] = $brandLogoPath;

        $variables = array(
            'invoice' => $invoiceArray,
            'company' => $companyDto->toArray(),
            'brand' => $brandArray,
            'callData' => $callData,
            'fixedCosts' => $this->fixedCosts,
            'fixedCostsTotals' => $this->fixedCostTotal,
            'totals' => $this->totals
        );

        /** @var InvoiceTemplate $templateModel */
        $templateModel = $invoice->getInvoiceTemplate();
        if (!$templateModel) {
            throw new \Exception('No template assigned.');
        }

        $this->logger->debug(self::LOGGER_PREFIX . ' Preparing templates');
        $templateEngine = new Handlebars;
        ;
        $header = $templateEngine->render($templateModel->getTemplateHeader(), $variables);
        $body = $templateEngine->render($templateModel->getTemplate(), $variables);
        $footer = $templateEngine->render($templateModel->getTemplateFooter(), $variables);

        $this->logger->debug(self::LOGGER_PREFIX . ' Rendering the PDF');
        $architecture = (php_uname('m') === 'x86_64') ? 'amd64' : 'i386';

        $snappy = new Pdf($this->vendorDir . 'bin/wkhtmltopdf-' . $architecture);
        $snappy->setTimeout(60 * 10);
        $snappy->setOption('header-html', $header);
        $snappy->setOption('header-spacing', 3);
        $snappy->setOption('footer-html', $footer);
        $snappy->setOption('footer-spacing', 3);
        $content = $snappy->getOutputFromHtml($body);
        $snappy->removeTemporaryFiles();

        return $content;
    }

    protected function _getCallData(InvoiceInterface $invoice)
    {
        $brand = $invoice->getBrand();
        $company = $invoice->getCompany();
        $lang = $company->getLanguageCode();
        $invoiceTz = new \DateTimeZone(
            $company->getDefaultTimezone()->getTz()
        );
        $utcTz = new \DateTimeZone('UTC');

        $currencySymbol = $company->getCurrencySymbol();

        $inDate = $invoice->getInDate();
        $utcInDate = $inDate->setTimezone($utcTz);

        $outDate = $invoice->getOutDate();
        $utcOutDate = $outDate->setTimezone($utcTz);

        $callsPerType = [];
        $callSumary = [];
        $callSumaryTotals = [
            'numberOfCalls' => 0,
            'totalCallsDuration' => 0,
            'totalCallsDurationFormatted' => $this->_timeFormat(0),
            'totalPrice' => 0,
        ];
        $inboundCalls = [];

        $this->setFixedCosts($invoice);

        $conditions = [
            ['brand', 'eq', $brand->getId()],
            ['company', 'eq', $company->getId()],
            ['carrier', 'isNotNull'],
            ['startTime', 'gte', $utcInDate->format(self::MYSQL_DATETIME_FORMAT)],
            ['startTime', 'lte', $utcOutDate->format(self::MYSQL_DATETIME_FORMAT)]
        ];
        $this->logger->debug('Where: ' . print_r($conditions, true));

        $this->billableCallRepository->setInvoiceId(
            $conditions,
            $invoice->getId()
        );

        $callGenerator = $this->billableCallRepository->getGeneratorByConditions(
            $conditions,
            50,
            ['self.startTime', 'ASC']
        );

        /** @var BillableCallInterface[] $calls */
        foreach ($callGenerator as $calls) {
            if (empty($calls)) {
                break;
            }

            foreach ($calls as $call) {
                $callDto = $this->entityTools->entityToDto($call);
                $callData = $callDto->toArray();
                $callData['calldate'] = $call
                    ->getStartTime()
                    ->setTimezone($invoiceTz)
                    ->format(self::DATE_TIME_FORMAT);

                $callData['dst'] = $call->getCallee();

                $callData['price'] = $this->roundAndFormat(
                    $call->getPrice()
                );

                $callData['currency'] = $currencySymbol;

                $callData['dst_duration_formatted'] = $this->_timeFormat(
                    $call->getDuration()
                );

                $callData['durationFormatted'] = $callData['dst_duration_formatted'];

                $callData['pricingPlan'] = [];
                $callData['targetPattern'] = [];

                $ratingPlanGroup = $call->getRatingPlanGroup();
                if ($ratingPlanGroup) {
                    /** @var RatingPlanGroupDto $ratingPlanGroupDto */
                    $ratingPlanGroupDto = $this->entityTools->entityToDto($ratingPlanGroup);

                    $callData['pricingPlan'] = $ratingPlanGroupDto->toArray();
                    $callData['pricingPlan']['name'] = $ratingPlanGroup->getName()->{'get' . $lang}();
                    $callData['pricingPlan']['description'] = $ratingPlanGroup->getDescription()->{'get' . $lang}();
                } else {
                    $callData['pricingPlan']['name'] = $call->getRatingPlanName();
                    $callData['pricingPlan']['description'] = '';
                }

                $destination = $call->getDestination();
                if ($destination) {
                    /** @var DestinationDto $destinationDto */
                    $destinationDto = $this->entityTools->entityToDto($destination);

                    $callData['targetPattern'] = $destinationDto->toArray();
                    $callData['targetPattern']['name'] = $destination->getName()->{'get' . $lang}();
                    $callData['targetPattern']['description'] = $destination->getName()->{'get' . $lang}();
                } else {
                    $callData['targetPattern']['name'] = $call->getDestinationName();
                    $callData['targetPattern']['description'] = '';
                }

                $callType = md5($callData['targetPattern']['name']);
                if (!isset($callsPerType[$callType])) {
                    $callsPerType[$callType] = array('items' => []);
                }
                $callsPerType[$callType]['items'][] = $callData;

                if (!isset($callSumary[$callType])) {
                    $callSumary[$callType] = [
                        'type' => $callData['targetPattern']['name'],
                        'numberOfCalls' => 0,
                        'totalCallsDuration' => 0,
                        'totalPrice' => 0,
                        'currency' => $currencySymbol
                    ];
                }

                $callSumary[$callType]['numberOfCalls'] += 1;
                $callSumary[$callType]['totalCallsDuration'] += $call->getDuration();
                $callSumary[$callType]['totalCallsDurationFormatted'] = $this->_timeFormat($callSumary[$callType]['totalCallsDuration']);
                $callSumary[$callType]['totalPrice'] = $this->sumAndFormat($callSumary[$callType]['totalPrice'], $callData['price']);

                $callSumaryTotals['numberOfCalls'] += 1;
                $callSumaryTotals['totalCallsDuration'] += $call->getDuration();
                $callSumaryTotals['totalCallsDurationFormatted'] = $this->_timeFormat($callSumaryTotals['totalCallsDuration']);
                $callSumaryTotals['totalPrice'] = $this->sumAndFormat($callSumaryTotals['totalPrice'], $callData['price']);
            }
        }

        $total = $callSumaryTotals['totalPrice'] + $this->fixedCostTotal;
        $totalTaxex = ceil(($total*$invoice->getTaxRate()/100)*10000)/10000;
        $totalWithTaxex = ceil(($totalTaxex + $total)*100)/100;

        $this->totals = array(
            'totalPrice' => $total,
            'totalTaxes' => $totalTaxex,
            'totalWithTaxes' => $totalWithTaxex
        );

        $this->logger->info('Saving TotalPrice and Total price with taxes');
        $this->logger->info('TotalPrice: ' . $total);
        $this->logger->info('Total price with taxes: ' . $totalWithTaxex);

        asort($callSumary);
        asort($callsPerType);
        $finalData = array(
            'callSumary' => array_values($callSumary),
            'callsPerType' => array_values($callsPerType),
            'callSumaryTotals' => $callSumaryTotals,
            'inboundCalls' => $inboundCalls,
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

    /**
     * @param InvoiceInterface $invoice
     */
    protected function setFixedCosts(InvoiceInterface $invoice)
    {
        $this->fixedCostTotal = 0;
        $fixedCostsRelInvoices = $invoice->getRelFixedCosts();

        $currencySymbol = $invoice->getCompany()->getCurrencySymbol();

        foreach ($fixedCostsRelInvoices as $key => $fixedCostsRelInvoice) {
            $cost = $fixedCostsRelInvoice->getFixedCost()->getCost();
            $quantity = $fixedCostsRelInvoice->getQuantity();
            $subTotal = $cost * $quantity;
            $this->fixedCosts[] = array(
                'quantity' => $quantity,
                'name' => $fixedCostsRelInvoice->getFixedCost()->getName(),
                'description' => $fixedCostsRelInvoice->getFixedCost()->getDescription(),
                'cost' => $this->roundAndFormat($cost),
                'subTotal' => $this->roundAndFormat($subTotal),
                'currency' => $currencySymbol
            );
            $this->fixedCostTotal += $this->roundAndFormat($subTotal);
        }
    }
}
