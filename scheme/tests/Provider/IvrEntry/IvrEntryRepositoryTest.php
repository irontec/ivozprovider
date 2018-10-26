<?php

namespace Tests\Provider\IvrEntry;

use Ivoz\Provider\Domain\Model\IvrEntry\IvrEntryRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Provider\Domain\Model\IvrEntry\IvrEntry;

class IvrEntryRepositoryTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @test
     */
    public function its_instantiable()
    {
        /** @var IvrEntryRepository $repository */
        $repository = $this
            ->em
            ->getRepository(IvrEntry::class);

        $this->assertInstanceOf(
            IvrEntryRepository::class,
            $repository
        );
    }
}