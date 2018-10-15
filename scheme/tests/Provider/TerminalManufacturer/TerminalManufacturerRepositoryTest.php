<?php

namespace Tests\Provider\TerminalManufacturer;

use Ivoz\Provider\Domain\Model\TerminalManufacturer\TerminalManufacturerRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Provider\Domain\Model\TerminalManufacturer\TerminalManufacturer;

class TerminalManufacturerRepositoryTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @test
     */
    public function its_instantiable()
    {
        /** @var TerminalManufacturerRepository $repository */
        $repository = $this
            ->em
            ->getRepository(TerminalManufacturer::class);

        $this->assertInstanceOf(
            TerminalManufacturerRepository::class,
            $repository
        );
    }
}