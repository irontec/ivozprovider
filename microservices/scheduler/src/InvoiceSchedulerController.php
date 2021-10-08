<?php

use Symfony\Component\HttpFoundation\Response;
use Ivoz\Provider\Domain\Service\Invoice\CreateByScheduler;
use Ivoz\Provider\Domain\Model\InvoiceScheduler\InvoiceSchedulerRepository;
use Ivoz\Core\Domain\Service\DomainEventPublisher;
use Ivoz\Core\Application\RequestId;
use Ivoz\Core\Application\RegisterCommandTrait;

class InvoiceSchedulerController
{
    use RegisterCommandTrait;

    public function __construct(
        DomainEventPublisher $eventPublisher,
        RequestId $requestId,
        private CreateByScheduler $invoiceCreator,
        private InvoiceSchedulerRepository $invoiceSchedulerRepository
    ) {
        $this->eventPublisher = $eventPublisher;
        $this->requestId = $requestId;
    }

    public function indexAction()
    {
        $this->registerCommand('Scheduler', 'invoiceScheduler');
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
