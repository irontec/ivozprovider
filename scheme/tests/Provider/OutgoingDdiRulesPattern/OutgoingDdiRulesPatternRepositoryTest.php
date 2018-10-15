<?php

namespace Tests\Provider\OutgoingDdiRulesPattern;

use Ivoz\Provider\Domain\Model\OutgoingDdiRulesPattern\OutgoingDdiRulesPatternRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Provider\Domain\Model\OutgoingDdiRulesPattern\OutgoingDdiRulesPattern;

class OutgoingDdiRulesPatternRepositoryTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @test
     */
    public function its_instantiable()
    {
        /** @var OutgoingDdiRulesPatternRepository $repository */
        $repository = $this
            ->em
            ->getRepository(OutgoingDdiRulesPattern::class);

        $this->assertInstanceOf(
            OutgoingDdiRulesPatternRepository::class,
            $repository
        );
    }
}