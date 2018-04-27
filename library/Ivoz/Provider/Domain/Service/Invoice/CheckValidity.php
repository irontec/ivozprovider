<?php

namespace Ivoz\Provider\Domain\Service\Invoice;

use Ivoz\Kam\Domain\Model\TrunksCdr\TrunksCdr;
use Ivoz\Kam\Domain\Model\TrunksCdr\TrunksCdrRepository;
use Ivoz\Provider\Domain\Model\Invoice\Invoice;
use Ivoz\Provider\Domain\Model\Invoice\InvoiceInterface;
use Ivoz\Provider\Domain\Model\Invoice\InvoiceRepository;
use Ivoz\Kam\Domain\Model\TrunksCdr\AccCdrRepository;

/**
 * Class CheckValidity
 * @package Ivoz\Provider\Domain\Invoice\CompanyAdmin
 * @lifecycle pre_persist
 */
class CheckValidity implements InvoiceLifecycleEventHandlerInterface
{
    const UNMETERED_CALLS = 50001;
    const INVOICES_FOUND_IN_THE_SAME_RANGE_OF_DATE = 50003;
    const UNBILLED_CALLS_AFTER_OUT_DATE = 50004;
    const SENSELESS_IN_OUT_DATE = 50005;
    const FORBIDDEN_FUTURE_DATES = 50006;

    /**
     * @var TrunksCdrRepository
     */
    protected $trunksCdrRepository;

    /**
     * @var InvoiceRepository
     */
    protected $invoiveRepository;

    public function __construct(
        TrunksCdrRepository $trunksCdrRepository,
        InvoiceRepository $invoiveRepository
    ) {
        $this->trunksCdrRepository = $trunksCdrRepository;
        $this->invoiveRepository = $invoiveRepository;
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_PRE_PERSIST => 10
        ];
    }

    /**
     * @throws \DomainException
     */
    public function execute(InvoiceInterface $entity)
    {
        $tz = $entity
            ->getCompany()
            ->getDefaultTimezone()
            ->getTz();
        $invoiceTz = new \DateTimeZone($tz);
        $utcTz = new \DateTimeZone('UTC');

        /**
         * @var \Datetime $inDate
         */
        $utcInDate = $entity->getInDate();
        $inDate = (clone $utcInDate)->setTimezone($invoiceTz);

        /**
         * @var \Datetime $outDate
         */
        $outDate = clone $entity->getOutDate();

        if ($entity->hasChanged('outDate')) {
            $oneSecAgo = new \DateInterval('PT1S');
            $outDate
                ->setTimezone($invoiceTz)
                ->add(new \DateInterval('P1D'))
                ->sub($oneSecAgo);

            $entity->setOutDate($outDate);
        }
        $utcOutDate = $outDate->setTimezone($utcTz);

        $now = (new \DateTime())->setTimezone($invoiceTz);
        $today = $now->setTime(0, 0, 0);
        if ($today < $inDate || $today < $outDate) {
            throw new \DomainException('', self::FORBIDDEN_FUTURE_DATES);
        }

        if ($inDate >= $outDate) {
            throw new \DomainException('', self::SENSELESS_IN_OUT_DATE);
        }

        $untarificattedCallNum = $this->trunksCdrRepository->countUntarificattedCallsBeforeDate(
            $entity->getCompany()->getId(),
            $entity->getBrand()->getId(),
            $utcOutDate->format('Y-m-d H:i:s')
        );

        if ($untarificattedCallNum > 0) {
            throw new \DomainException('', self::UNMETERED_CALLS);
        }

        /**
         * @var Invoice[] $invoices
         */
        $invoices = $this
            ->invoiveRepository
            ->getInvoices(
                $entity->getCompany()->getId(),
                $entity->getBrand()->getId(),
                $utcOutDate->format('Y-m-d H:i:s'),
                $entity->getId()
            );

        if (!empty($invoices)) {

            $invoice = $invoices[0];
            $nextInvoiceInDate = $invoice->getInDate();

            $calls = $this->trunksCdrRepository->countUntarificattedCallsInRange(
                $entity->getCompany()->getId(),
                $entity->getBrand()->getId(),
                $utcOutDate->format('Y-m-d H:i:s'),
                $nextInvoiceInDate->setTimezone($utcTz)->format('Y-m-d H:i:s')
            );

            if ($calls > 0) {
                throw new \DomainException('', self::UNBILLED_CALLS_AFTER_OUT_DATE);
            }
        }

        $invoiceCount = $this->invoiveRepository->fetchInvoiceNumberInRange(
            $entity->getCompany()->getId(),
            $entity->getBrand()->getId(),
            $utcInDate->format('Y-m-d H:i:s'),
            $utcOutDate->format('Y-m-d H:i:s'),
            $entity->getId()
        );

        if ($invoiceCount) {
            throw new \DomainException('', self::INVOICES_FOUND_IN_THE_SAME_RANGE_OF_DATE);
        }
    }
}