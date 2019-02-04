<?php

use Symfony\Component\HttpFoundation\Response;
use Ivoz\Provider\Domain\Service\Invoice\CreateByScheduler;
use Ivoz\Provider\Domain\Model\InvoiceScheduler\InvoiceSchedulerRepository;

class InvoiceSchedulerController
{
    /**
     * @var CreateByScheduler
     */
    private $invoiceCreator;

    /**
     * @var InvoiceSchedulerRepository
     */
    private $invoiceSchedulerRepository;

    public function __construct(
        CreateByScheduler $invoiceCreator,
        InvoiceSchedulerRepository $invoiceSchedulerRepository
    ) {
        $this->invoiceCreator = $invoiceCreator;
        $this->invoiceSchedulerRepository = $invoiceSchedulerRepository;
    }

    public function indexAction()
    {
        $invoiceSchedulers = $this->invoiceSchedulerRepository->getPendingSchedulers();
        try {
            foreach ($invoiceSchedulers as $invoiceScheduler) {
                $this->invoiceCreator->execute($invoiceScheduler);
            }
        } catch (\Exception $e) {
            return new Response(
                $e->getMessage() . "\n",
                500
            );
        }

        return new Response("Done!\n", 200);
    }
}
