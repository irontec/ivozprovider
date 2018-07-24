<?php

namespace Ivoz\Provider\Domain\Service\Invoice;

use Ivoz\Provider\Domain\Model\RatingPlan\RatingPlanDto;
use Ivoz\Provider\Domain\Model\RatingPlan\RatingPlanRepository;
use Ivoz\Cgr\Domain\Model\TpCdr\TpCdr;
use Ivoz\Cgr\Domain\Model\TpCdr\TpCdrInterface;
use Ivoz\Cgr\Domain\Model\TpCdr\TpCdrRepository;
use Ivoz\Cgr\Domain\Model\TpDestination\TpDestinationRepository;
use Ivoz\Core\Application\Service\Assembler\DtoAssembler;
use Ivoz\Kam\Domain\Model\TrunksCdr\TrunksCdrInterface;
use Ivoz\Kam\Domain\Model\TrunksCdr\TrunksCdrRepository;
use Ivoz\Provider\Domain\Model\Invoice\InvoiceInterface;
use Ivoz\Provider\Domain\Model\Invoice\InvoiceRepository;
use Ivoz\Provider\Domain\Model\InvoiceTemplate\InvoiceTemplate;
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
     * @var TrunksCdrRepository
     */
    protected $trunksCdrRepository;

    /**
     * @var RatingPlanRepository
     */
    protected $ratingPlanRepository;

    /**
     * @var TpDestinationRepository
     */
    protected $tpDestinationRepository;

    /**
     * @var DtoAssembler
     */
    protected $dtoAssembler;

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
     * @param TrunksCdrRepository $trunksCdrRepository
     * @param TpCdrRepository $tpCdrRepository
     * @param RatingPlanRepository $ratingPlanRepository
     * @param TpDestinationRepository $destinationRepository
     * @param DtoAssembler $dtoAssembler
     * @param Logger $logger
     * @param string $vendorDir
     */
    public function __construct(
        InvoiceRepository $invoiceRepository,
        TrunksCdrRepository $trunksCdrRepository,
        TpCdrRepository $tpCdrRepository,
        RatingPlanRepository $ratingPlanRepository,
        TpDestinationRepository $destinationRepository,
        DtoAssembler $dtoAssembler,
        Logger $logger,
        string $vendorDir
    ) {
        $this->invoiceRepository = $invoiceRepository;
        $this->trunksCdrRepository = $trunksCdrRepository;
        $this->tpCdrRepository = $tpCdrRepository;
        $this->ratingPlanRepository = $ratingPlanRepository;
        $this->tpDestinationRepository = $destinationRepository;
        $this->dtoAssembler = $dtoAssembler;
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
        $brandDto = $this->dtoAssembler->toDto($brand);
        $brandLogoPath = $brandDto->getLogoPath();
        if (!file_exists($brandLogoPath)) {
            $brandLogoPath = 'images/palmera90.png';
        }

        $company = $invoice->getCompany();
        $companyDto = $this->dtoAssembler->toDto($company);
        $invoiceTz = new \DateTimeZone(
            $company->getDefaultTimezone()->getTz()
        );
        $invoiceDate = new \DateTime();
        $invoiceDate->setTimezone($invoiceTz);

        $inDate = clone $invoice->getInDate();
        $inDate->setTimezone($invoiceTz);

        $outDate = clone $invoice->getOutDate();
        $outDate->setTimezone($invoiceTz);

        $invoiceDto = $this->dtoAssembler->toDto($invoice);

        $invoiceArray = $invoiceDto->toArray();
        $invoiceArray['invoiceDate'] = $invoiceDate->format(self::DATE_FORMAT);
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
        $templateEngine = new Handlebars;;
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

        $inDate = clone $invoice->getInDate();
        $utcInDate = $inDate->setTimezone($utcTz);

        $outDate = clone $invoice->getOutDate();
        $utcOutDate = $outDate->setTimezone($utcTz);

        $callsPerType = [];
        $callSumary = [];
        $callSumaryTotals = [
            'numberOfCalls' => 0,
            'totalCallsDuration' => 0,
            'totalCallsDurationFormatted' => $this->_timeFormat(0),
            'totalPrice' => 0
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

        $this->trunksCdrRepository->setInvoiceId(
            $conditions,
            $invoice->getId()
        );

        $callGenerator = $this->trunksCdrRepository->getGeneratorByConditions(
            $conditions,
            50,
            ['self.startTime', 'ASC']
        );

        /** @var TrunksCdrInterface[] $calls */
        foreach ($callGenerator as $calls) {

            if (empty($calls)) {
                break;
            }

            foreach ($calls as $call) {

                $callDto = $this->dtoAssembler->toDto($call);
                $callData = $callDto->toArray();
                $callData['calldate'] = $call
                    ->getStartTime()
                    ->setTimezone($invoiceTz)
                    ->format(self::DATE_TIME_FORMAT);

                $callData['dst'] = $call->getCallee();

                /** @var TpCdrInterface $tpCdr */
                $tpCdr = null;
                if ($call->getCgrid()) {
                    $tpCdr = $this->tpCdrRepository->getOneByCgrid($call->getCgrid());
                }

                $price = $tpCdr
                    ? $tpCdr->getCost()
                    : $call->getPrice();
                $callData['price'] = $this->roundAndFormat($price);

                $duration = $tpCdr
                    ? $tpCdr->getDuration()
                    : $call->getDuration();
                $callData['dst_duration_formatted'] = $this->_timeFormat($duration);

                /** @todo WTF */
                $callData['durationFormatted'] = $callData['dst_duration_formatted'];

                $callData['pricingPlan'] = [];
                $callData['targetPattern'] = [];

                if ($tpCdr) {
                    // Checkpoint
                    $costDetails = $tpCdr->getCostDetails();
                    $timespan = $costDetails['Timespans'][0];
                    $ratingPlanTag = $timespan['RatingPlanId'];
                    $ratingPlan = $this->ratingPlanRepository->findOneByTag($ratingPlanTag);

                    /** @var RatingPlanDto $ratingPlanDto */
                    $ratingPlanDto = $this->dtoAssembler->toDto($ratingPlan);

                    $callData['pricingPlan'] = $ratingPlanDto->toArray();
                    $callData['pricingPlan']['name'] = $ratingPlan->getName()->{'get' . $lang}();
                    $callData['pricingPlan']['description'] = $ratingPlan->getDescription()->{'get' . $lang}();

                    // -----------------

                    $matchedDestTag = $timespan['MatchedDestId'];
                    $destination = $this->tpDestinationRepository->findOneByTag($matchedDestTag);
                    $destinationDto = $this->dtoAssembler->toDto($destination);

                    $callData['targetPattern'] = $destinationDto->toArray();
                    $callData['targetPattern']['name'] = $destination->getName();
                    $callData['targetPattern']['description'] = $destination->getName();

                }  else if ($call->getDestinationRate()) {

                    /* Legacy path */
                    $destinationRate = $call->getDestinationRate();
                    $destinationRateDto = $this->dtoAssembler->toDto($destinationRate);

                    $callData['pricingPlan'] = $destinationRateDto->toArray();
                    $callData['pricingPlan']['name'] = $destinationRate->getName()->{'get' . $lang}();
                    $callData['pricingPlan']['description'] = $destinationRate->getDescription()->{'get' . $lang}();

                    // -----------------

                    $destination = $call->getTpDestination();
                    $destinationDto = $this->dtoAssembler->toDto($destination);

                    $callData['targetPattern'] = $destinationDto->toArray();
                    $callData['targetPattern']['name'] = $destination->getName();
                    $callData['targetPattern']['description'] = $destination->getName();

                } else {

                    $callData['pricingPlan']['name'] = '';
                    $callData['pricingPlan']['description'] = '';

                    $callData['targetPattern']['name'] = '';
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
                        'totalPrice' => 0
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
     * @param $call
     * @return mixed
     */
    protected function getCallPricingPlan(TrunksCdrInterface $call)
    {
        $pricingPlanId = $call->getPricingPlanId();
        if (!array_key_exists($pricingPlanId, $this->pricingPlanCache)) {
            $this->pricingPlanCache[$pricingPlanId] = $call->getPricingPlan();
        }

        return $this->pricingPlanCache[$pricingPlanId];
    }

    /**
     * @param InvoiceInterface $invoice
     */
    protected function setFixedCosts(InvoiceInterface $invoice)
    {
        $this->fixedCostTotal = 0;
        $fixedCostsRelInvoices = $invoice->getRelFixedCosts();

        foreach ($fixedCostsRelInvoices as $key => $fixedCostsRelInvoice) {
            $cost = $fixedCostsRelInvoice->getFixedCost()->getCost();
            $quantity = $fixedCostsRelInvoice->getQuantity();
            $subTotal = $cost * $quantity;
            $this->fixedCosts[] = array(
                'quantity' => $quantity,
                'name' => $fixedCostsRelInvoice->getFixedCost()->getName(),
                'description' => $fixedCostsRelInvoice->getFixedCost()->getDescription(),
                'cost' => $this->roundAndFormat($cost),
                'subTotal' => $this->roundAndFormat($subTotal)
            );
            $this->fixedCostTotal += $this->roundAndFormat($subTotal);
        }
    }
}