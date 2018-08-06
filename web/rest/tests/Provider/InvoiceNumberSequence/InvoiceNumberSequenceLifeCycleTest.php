<?php

namespace Tests\Provider\InvoiceNumberSequence;

use Ivoz\Provider\Domain\Model\InvoiceNumberSequence\InvoiceNumberSequence;
use Ivoz\Provider\Domain\Model\InvoiceNumberSequence\InvoiceNumberSequenceDto;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;

class InvoiceNumberSequenceLifeCycleTestLifeCycleTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @return InvoiceNumberSequenceDto
     */
    protected function getInvoiceNumberSequencePdo()
    {
        $invoiceNumberSequenceDto = new InvoiceNumberSequenceDto();
        $invoiceNumberSequenceDto
             ->setName('numSeq')
             ->setPrefix('prefix-')
             ->setSequenceLength(1)
             ->setIncrement(1)
             ->setBrandId(1);

        return $invoiceNumberSequenceDto;
    }

    /**
     * @return InvoiceNumberSequence
     */
    protected function addInvoiceNumberSequence()
    {
        return $this
            ->entityTools
            ->persistDto(
                $this->getInvoiceNumberSequencePdo(),
                null,
                true
            );
    }

    /**
     * @test
     */
    public function it_persists_invoiceNumberSequences()
    {
        $extensionRepository = $this->em
            ->getRepository(InvoiceNumberSequence::class);

        $fixtureInvoices = $extensionRepository->findAll();
        $this->assertCount(1, $fixtureInvoices);

        $this->addInvoiceNumberSequence();

        $extensions = $extensionRepository->findAll();
        $this->assertCount(
            count($fixtureInvoices) + 1,
            $extensions
        );
    }

    /**
     * @test
     */
    public function it_throws_exception_on_invalid_version()
    {
        $entity = $this->em->find(
            InvoiceNumberSequence::class,
            1
        );

        $this->expectException(
            \Doctrine\ORM\OptimisticLockException::class
        );
        $this->entityTools->lock($entity, $entity->getVersion()-1);
    }
}
