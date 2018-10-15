<?php

namespace Tests\Provider\RoutingPatternGroup;

use Ivoz\Provider\Domain\Model\RoutingPatternGroup\RoutingPatternGroupRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Provider\Domain\Model\RoutingPatternGroup\RoutingPatternGroup;
use Ivoz\Provider\Domain\Model\RoutingPatternGroup\RoutingPatternGroupInterface;

class RoutingPatternGroupRepositoryTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @test
     */
    public function its_instantiable()
    {
        /** @var RoutingPatternGroupRepository $repository */
        $repository = $this
            ->em
            ->getRepository(RoutingPatternGroup::class);

        $this->assertInstanceOf(
            RoutingPatternGroupRepository::class,
            $repository
        );
    }

    /**
     * @test
     */
    public function its_finds_brandId_and_name()
    {
        /** @var RoutingPatternGroupRepository $repository */
        $repository = $this
            ->em
            ->getRepository(RoutingPatternGroup::class);

        $response = $repository
            ->findByBrandIdAndName(
                1,
                'Europe'
            );

        $this->assertInstanceOf(
            RoutingPatternGroupInterface::class,
            $response
        );
    }
}