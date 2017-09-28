<?php

namespace Ivoz\Provider\Domain\Service\Invoice;

use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\EntityManagerInterface;
use Ivoz\Provider\Domain\Model\Invoice\Invoice;
use Ivoz\Provider\Domain\Model\Invoice\InvoiceInterface;
use Ivoz\Provider\Domain\Model\Invoice\InvoiceRepository;
use Ivoz\Kam\Domain\Model\AccCdr\AccCdrRepository;

/**
 * Class CheckValidity
 * @package Ivoz\Provider\Domain\Invoice\CompanyAdmin
 * @lifecycle pre_persist
 */
class CheckValidity implements InvoiceLifecycleEventHandlerInterface
{
    /**
     * @var EntityManagerInterface
     */
    protected $em;

    /**
     * @var AccCdrRepository
     */
    protected $accCdrRepository;

    /**
     * @var InvoiceRepository
     */
    protected $invoiveRepository;

    public function __construct(
        EntityManagerInterface $em,
        AccCdrRepository $accCdrRepository,
        InvoiceRepository $invoiveRepository
    ) {
        $this->em = $em;
        $this->accCdrRepository = $accCdrRepository;
        $this->invoiveRepository = $invoiveRepository;
    }

    /**
     * @throws \Exception
     */
    public function execute(InvoiceInterface $entity)
    {
        $tz = $entity
            ->getCompany()
            ->getDefaultTimezone()
            ->getTz();
        $invoiceTz = new \DateTimeZone($tz);
        /**
         * @var \Datetime $inDate
         */
        $inDate = $entity->getInDate();
        $inDate->setTimezone($invoiceTz);

        /**
         * @var \Datetime $outDate
         */
        $outDate = $entity->getOutDate();
        $outDate
            ->setTimezone($invoiceTz)
            ->add(new \DateInterval('P1D'))
            ->sub(new \DateInterval('-PT1S'));

        /**
         * @todo double check this
         */
        if ($inDate >= $outDate) {
            throw new \Excepion('', 50005);
        }

//        $now = new \Zend_Date();
//        $now->setTimezone($invoiceTz);
//        $inDateIsInFuture = $invoice->getInDate(true)->getDate()->compare($now->getDate()) >= 0;
//        $outDateIsInFuture = $invoice->getOutDate(true)->getDate()->compare($now->getDate()) >= 0;
//
//
////        if ($inDateIsInFuture || $outDateIsInFuture) {
////            return 50006;
////        }

        $where = [
            "company" => $entity->getCompany()->getId(),
            "brand" => $entity->getBrand()->getId(),
            Criteria::expr()->lte('start_time_utc', $outDate->format('Y-m-d H:i:s')),
            "metered" => '0'
        ];

        $untarificattedCalls = $this->accCdrRepository->fetchTarificableList($where);
        if (!empty($untarificattedCalls)) {
            throw new \Excepion('', 50001);
        }

        $utcTimezone = new \DateTimeZone('UTC');
        $utcOutDate = $outDate
            ->setTimezone($invoiceTz)
            ->format('Y-m-d H:i:s');

        $where = array(
            "company" => $entity->getCompany()->getId(),
            "brand" => $entity->getBrand()->getId(),
            Criteria::expr()->gt('outDate', $utcOutDate),
            Criteria::expr()->neq('id', $entity->getId())
        );

        /**
         * @var Invoice[] $invoices
         */
        $invoices = $this
            ->invoiveRepository
            ->findBy($where, ['inDate' => 'ASC']);

        if (!empty($invoices)) {

            $invoice = $invoices[0];
            $nextInvoiceInDate = $invoice->getInDate();

            $where = array(
                "company" => $invoice->getCompany()->getId(),
                "brand" => $invoice->getBrand->getId(),
                Criteria::expr()->gt('startTimeUtc', $outDate->setTimezone($invoiceTz)->format('Y-m-d H:i:s')),
                Criteria::expr()->lt('startTimeUtc', $nextInvoiceInDate->setTimezone($invoiceTz)->format('Y-m-d H:i:s'))
            );

            $calls = $this->accCdrRepository->fetchTarificableList($where);
            if (!empty($calls)) {
                throw new \Excepion('', 50004);
            }
        }

        $utcInDate = $inDate
            ->setTimezone($invoiceTz)
            ->format('Y-m-d H:i:s');

        $where = array(
            "company" => $invoice->getCompany()->getId(),
            "brand" => $invoice->getBrand->getId(),
            Criteria::expr()->gte('inDate', $utcInDate),
            Criteria::expr()->lte('outDate', $utcOutDate),
            Criteria::expr()->neq('id', $invoice->getId())
        );

        $invoices = $this->invoiveRepository->findBy($where);
        if (!empty($invoices)) {
            throw new \Excepion('', 50003);
        }

    }
}