<?php

use Symfony\Component\HttpFoundation\Response;
use Ivoz\Provider\Domain\Service\BillableCall\MigrateFromTrunksCdr as BillableCallFromTrunksCdr;

class BillableCallController
{
    protected $billableCallFromTrunksCdr;

    public function __construct(
        BillableCallFromTrunksCdr $billableCallFromTrunksCdr
    ) {
        $this->billableCallFromTrunksCdr = $billableCallFromTrunksCdr;
    }

    public function indexAction()
    {
        try {
            $this->billableCallFromTrunksCdr->execute();
        } catch (\Exception $e) {
            return new Response(
                $e->getMessage() . "\n",
                500
            );
        }

        return new Response("BillableCall migration done!\n", 200);
    }
}