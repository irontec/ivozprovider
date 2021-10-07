<?php

namespace Tests\Provider\InvoiceNumberSequence;

use Ivoz\Provider\Domain\Model\InvoiceNumberSequence\InvoiceNumberSequence;
use Ivoz\Provider\Domain\Model\InvoiceNumberSequence\InvoiceNumberSequenceDto;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;

class InvoiceNumberSequenceLifeCycleTest extends KernelTestCase
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

    protected function addInvoiceNumberSequence()
    {
        $dto = $this->getInvoiceNumberSequencePdo();
        return $this
            ->entityTools
            ->persistDto(
                $dto,
                null,
                true
            );
    }

    protected function updateInvoiceNumberSequence()
    {
        $invoiceNumberSequenceRepository = $this->em
            ->getRepository(InvoiceNumberSequence::class);

        $invoiceNumberSequence = $invoiceNumberSequenceRepository->find(1);

        /** @var InvoiceNumberSequenceDto $invoiceNumberSequenceDto */
        $invoiceNumberSequenceDto = $this->entityTools->entityToDto($invoiceNumberSequence);

        $invoiceNumberSequenceDto
            ->setName('updatedName');

        return $this
            ->entityTools
            ->persistDto($invoiceNumberSequenceDto, $invoiceNumberSequence, true);
    }

    protected function removeInvoiceNumberSequence()
    {
        $invoiceNumberSequenceRepository = $this->em
            ->getRepository(InvoiceNumberSequence::class);

        $invoiceNumberSequence = $invoiceNumberSequenceRepository->find(1);

        $this
            ->entityTools
            ->remove($invoiceNumberSequence);
    }

    /**
     * @test
     */
    public function it_persists_invoiceNumberSequences()
    {
        $extensionRepository = $this->em
            ->getRepository(InvoiceNumberSequence::class);
        $fixtureInvoices = $extensionRepository->findAll();

        $this->addInvoiceNumberSequence();

        $extensions = $extensionRepository->findAll();
        $this->assertCount(
            count($fixtureInvoices) + 1,
            $extensions
        );

        ///////////////////////////
        ///
        ///////////////////////////

        $this->it_triggers_lifecycle_services();
    }

    protected function it_triggers_lifecycle_services()
    {
        $this->assetChangedEntities([
            InvoiceNumberSequence::class
        ]);
    }

    /**
     * @test
     */
    public function it_triggers_update_lifecycle_services()
    {
        $this->updateInvoiceNumberSequence();
        $this->assetChangedEntities([
            InvoiceNumberSequence::class
        ]);
    }

    /**
     * @test
     */
    public function it_triggers_remove_lifecycle_services()
    {
        $this->removeInvoiceNumberSequence();
        $this->assetChangedEntities([
            InvoiceNumberSequence::class
        ]);
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
        $this->entityTools->lock($entity, $entity->getVersion() - 1);
    }
}
