<?php

namespace Tests\Provider\TerminalModel;

use Ivoz\Provider\Domain\Model\TerminalModel\TerminalModel;
use Ivoz\Provider\Domain\Model\TerminalModel\TerminalModelRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;

class TerminalModelRepositoryTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @test
     */
    public function test_runner()
    {
        $this->it_finds_one_by_generic_template();
    }

    public function it_finds_one_by_generic_template()
    {

        /** @var TerminalModelRepository $terminalModelRepository */
        $terminalModelRepository = $this->em
            ->getRepository(TerminalModel::class);

        $terminalModel = $terminalModelRepository
            ->findOneByGenericUrlPattern('y000000000034.cfg');

        $this->assertEquals(
            null,
            $terminalModel
        );
    }
}
