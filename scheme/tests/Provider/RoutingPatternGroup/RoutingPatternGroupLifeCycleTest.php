<?php

namespace Tests\Provider\RoutingPatternGroup;

use Ivoz\Cgr\Domain\Model\TpRoutingPatternGroup\TpRoutingPatternGroup;
use Ivoz\Provider\Domain\Model\RoutingPatternGroup\RoutingPatternGroupDto;
use Ivoz\Provider\Domain\Model\RoutingPatternGroupsRelPattern\RoutingPatternGroupsRelPattern;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Provider\Domain\Model\RoutingPatternGroup\RoutingPatternGroup;

class RoutingPatternGroupLifeCycleTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @return RoutingPatternGroupDto
     */
    protected function createDto()
    {
        $routingPatternDto = new RoutingPatternGroupDto();
        $routingPatternDto
            ->setName('testRoutingPatternGroup')
            ->setDescription('description')
            ->setBrandId(1)
            ->setRelPatterns([])
            ->setOutgoingRoutings([]);

        return $routingPatternDto;
    }

    /**
     * @return RoutingPatternGroup
     */
    protected function addRoutingPatternGroup()
    {
        $routingPatternDto = $this->createDto();

        /** @var RoutingPatternGroup $routingPattern */
        $routingPattern = $this->entityTools
            ->persistDto($routingPatternDto, null, true);

        return $routingPattern;
    }

    protected function updateRoutingPatternGroup()
    {
        $routingPatternGroupRepository = $this->em
            ->getRepository(RoutingPatternGroup::class);

        $routingPatternGroup = $routingPatternGroupRepository->find(1);

        /** @var RoutingPatternGroupDto $routingPatternGroupDto */
        $routingPatternGroupDto = $this->entityTools->entityToDto($routingPatternGroup);

        $routingPatternGroupDto
            ->setName('updatedName');

        return $this
            ->entityTools
            ->persistDto($routingPatternGroupDto, $routingPatternGroup, true);
    }

    protected function removeRoutingPatternGroup()
    {
        $routingPatternGroupRepository = $this->em
            ->getRepository(RoutingPatternGroup::class);

        $routingPatternGroup = $routingPatternGroupRepository->find(1);

        $this
            ->entityTools
            ->remove($routingPatternGroup);
    }

    
    /**
     * @test
     */
    public function it_persists_routingPattern_groups()
    {
        $routingPattern = $this->em
            ->getRepository(RoutingPatternGroup::class);
        $fixtureRoutingPatternGroups = $routingPattern->findAll();

        $this->addRoutingPatternGroup();

        $brands = $routingPattern->findAll();
        $this->assertCount(count($fixtureRoutingPatternGroups) + 1, $brands);
    }

    /**
     * @test
     */
    public function it_triggers_lifecycle_services()
    {
        $this->addRoutingPatternGroup();
        $this->assetChangedEntities([
            RoutingPatternGroup::class,
        ]);
    }

    /**
     * @test
     */
    public function it_triggers_update_lifecycle_services()
    {
        $this->updateRoutingPatternGroup();
        $this->assetChangedEntities([
            RoutingPatternGroup::class,
        ]);
    }

    /**
     * @test
     */
    public function it_triggers_remove_lifecycle_services()
    {
        $this->removeRoutingPatternGroup();
        $this->assetChangedEntities([
            RoutingPatternGroupsRelPattern::class,
            RoutingPatternGroup::class,
        ]);
    }
}
