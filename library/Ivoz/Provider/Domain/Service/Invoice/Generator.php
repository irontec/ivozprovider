<?php

namespace Ivoz\Provider\Domain\Service\Invoice;

use Handlebars\Handlebars;
use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\BillableCall\BillableCallInterface;
use Ivoz\Provider\Domain\Model\BillableCall\BillableCallRepository;
use Ivoz\Provider\Domain\Model\Destination\DestinationDto;
use Ivoz\Provider\Domain\Model\Invoice\InvoiceInterface;
use Ivoz\Provider\Domain\Model\Invoice\InvoiceRepository;
use Ivoz\Provider\Domain\Model\InvoiceTemplate\InvoiceTemplate;
use Ivoz\Provider\Domain\Model\RatingPlanGroup\RatingPlanGroupDto;
use Knp\Snappy\Pdf;
use Monolog\Logger;

class Generator
{
    public const DATE_FORMAT = 'd-m-Y';
    public const DATE_TIME_FORMAT = 'd-m-Y H:i:s';

    public const LOGGER_PREFIX = '[Invoices][Generator]';

    private $invoiceId;
    private $fixedCostTotal = 0;
    private $fixedCosts = array();
    private $totals = array();

    /**
     * @var InvoiceRepository
     */
    private $invoiceRepository;

    /**
     * @var BillableCallRepository
     */
    private $billableCallRepository;

    /**
     * @var EntityTools
     */
    private $entityTools;

    /**
     * @var Logger
     */
    private $logger;

    /**
     * @var string
     */
    private $vendorDir;

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

    public function setInvoiceId(int $id): self
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
    public function getInvoicePDFContents(int $invoiceId): string
    {
        $this->setInvoiceId($invoiceId);
        return $this->_createInvoice();
    }

    protected function _createInvoice(): string
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
        $inDate = $inDate->setTimezone($invoiceTz);

        $outDate = $invoice->getOutDate();
        $outDate = $outDate->setTimezone($invoiceTz);

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
        $templateEngine = new Handlebars();

        $header = $templateEngine->render($templateModel->getTemplateHeader(), $variables);
        $body = $templateEngine->render($templateModel->getTemplate(), $variables);
        $footer = $templateEngine->render($templateModel->getTemplateFooter(), $variables);

        $this->logger->debug(self::LOGGER_PREFIX . ' Rendering the PDF');

        $snappy = new Pdf($this->vendorDir . 'bin/wkhtmltopdf-amd64');
        $snappy->setTimeout(60 * 10);
        $snappy->setOption('header-html', $header);
        $snappy->setOption('header-spacing', 3);
        $snappy->setOption('footer-html', $footer);
        $snappy->setOption('footer-spacing', 3);
        $snappy->setOption('load-error-handling', 'ignore');
        $snappy->setOption('enable-local-file-access', true);

        $content = $snappy->getOutputFromHtml($body);
        $snappy->removeTemporaryFiles();

        return $content;
    }

    /**
     * @return array
     */
    protected function _getCallData(InvoiceInterface $invoice): array
    {
        $company = $invoice->getCompany();
        $lang = $company->getLanguageCode();
        $invoiceTz = new \DateTimeZone(
            $company->getDefaultTimezone()->getTz()
        );
        $currencySymbol = $company->getCurrencySymbol();

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

        $this
            ->billableCallRepository
            ->setInvoiceId(
                $invoice
            );

        $callGenerator = $this->billableCallRepository->getGeneratorByInvoice(
            $invoice
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
        $total = ceil($total * 100) / 100;

        $totalTaxex = ceil(($total * $invoice->getTaxRate() / 100) * 100) / 100;
        $totalWithTaxex = $totalTaxex + $total;

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

        return array(
            'callSumary' => array_values($callSumary),
            'callsPerType' => array_values($callsPerType),
            'callSumaryTotals' => $callSumaryTotals,
            'inboundCalls' => $inboundCalls,
        );
    }

    /**
     * @param string|float|int $value
     * @param string|float|int $value2
     * @return string
     */
    protected function sumAndFormat($value, $value2): string
    {
        return $this->formatNumber(
            $this->sumConcepts($value, $value2)
        );
    }

    /**
     * @param string|float|int $value
     * @param string|float|int $value2
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
     * @param string|float|int $value
     * @param int $decimals
     * @return string
     */
    protected function roundAndFormat($value, $decimals = 4): string
    {
        return $this->formatNumber(
            $this->roundNumber($value, $decimals)
        );
    }

    /**
     * @param string|float|int $value
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
    protected function formatNumber($number): string
    {
        return number_format(
            $number,
            4,
            '.',
            ''
        );
    }

    /**
     * @param float|int $seconds
     */
    protected function _timeFormat(int|float $seconds): string
    {
        $hours = floor($seconds / 3600);
        $mins = floor($seconds / 60 % 60);
        $secs = floor($seconds % 60);
        return sprintf('%02d:%02d:%02d', $hours, $mins, $secs);
    }

    /**
     * @param InvoiceInterface $invoice
     *
     * @return void
     */
    protected function setFixedCosts(InvoiceInterface $invoice)
    {
        $this->fixedCostTotal = 0;
        $fixedCostsRelInvoices = $invoice->getRelFixedCosts();

        $currencySymbol = $invoice->getCompany()->getCurrencySymbol();

        foreach ($fixedCostsRelInvoices as $fixedCostsRelInvoice) {
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
