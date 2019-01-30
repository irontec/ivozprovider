<?php

namespace Tests\Provider\FixedCostsRelInvoice;

use Ivoz\Provider\Domain\Model\FixedCostsRelInvoice\FixedCostsRelInvoiceRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Provider\Domain\Model\FixedCostsRelInvoice\FixedCostsRelInvoice;

class FixedCostsRelInvoiceRepositoryTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @test
     */
    public function its_instantiable()
    {
        /** @var FixedCostsRelInvoiceRepository $repository */
        $repository = $this
            ->em
            ->getRepository(FixedCostsRelInvoice::class);

        $this->assertInstanceOf(
            FixedCostsRelInvoiceRepository::class,
            $repository
        );
    }
}
