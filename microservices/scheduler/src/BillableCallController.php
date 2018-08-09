<?php

use Symfony\Component\HttpFoundation\Response;
use Ivoz\Provider\Domain\Service\Invoice\CreateByScheduler;
use Ivoz\Provider\Domain\Model\InvoiceScheduler\InvoiceSchedulerRepository;

class BillableCallController
{
    public function __construct()
    {
        $cosa = 1;
    }

    public function indexAction()
    {
        return new Response("BillableCallController::index done!\n", 200);
    }
}