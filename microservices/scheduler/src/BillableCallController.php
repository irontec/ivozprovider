<?php

use Symfony\Component\HttpFoundation\Response;
use Ivoz\Provider\Domain\Service\BillableCall\MigrateFromTrunksCdr as BillableCallFromTrunksCdr;
use Psr\Log\LoggerInterface;

class BillableCallController
{
    /**
     * @var BillableCallFromTrunksCdr
     */
    protected $billableCallFromTrunksCdr;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    public function __construct(
        BillableCallFromTrunksCdr $billableCallFromTrunksCdr,
        LoggerInterface $logger
    ) {
        $this->billableCallFromTrunksCdr = $billableCallFromTrunksCdr;
        $this->logger = $logger;
    }

    public function indexAction()
    {
        try {
            $this->billableCallFromTrunksCdr->execute();
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
            return new Response(
                $e->getMessage() . "\n",
                500
            );
        }

        return new Response("BillableCall migration done!\n", 200);
    }
}
