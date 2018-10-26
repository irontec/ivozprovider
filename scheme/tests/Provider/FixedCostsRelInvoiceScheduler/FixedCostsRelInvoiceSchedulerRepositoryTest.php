<?php

namespace Tests\Provider\FixedCostsRelInvoiceScheduler;

use Ivoz\Provider\Domain\Model\FixedCostsRelInvoiceScheduler\FixedCostsRelInvoiceSchedulerRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Provider\Domain\Model\FixedCostsRelInvoiceScheduler\FixedCostsRelInvoiceScheduler;

class FixedCostsRelInvoiceSchedulerRepositoryTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @test
     */
    public function its_instantiable()
    {
        /** @var FixedCostsRelInvoiceSchedulerRepository $repository */
        $repository = $this
            ->em
            ->getRepository(FixedCostsRelInvoiceScheduler::class);

        $this->assertInstanceOf(
            FixedCostsRelInvoiceSchedulerRepository::class,
            $repository
        );
    }
}