<?php

namespace Tests\Provider\InvoiceTemplate;

use Ivoz\Provider\Domain\Model\InvoiceTemplate\InvoiceTemplateRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Provider\Domain\Model\InvoiceTemplate\InvoiceTemplate;

class InvoiceTemplateRepositoryTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @test
     */
    public function its_instantiable()
    {
        /** @var InvoiceTemplateRepository $repository */
        $repository = $this
            ->em
            ->getRepository(InvoiceTemplate::class);

        $this->assertInstanceOf(
            InvoiceTemplateRepository::class,
            $repository
        );
    }
}
