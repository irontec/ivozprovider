<?php

namespace Tests\Provider\RoutingPatternGroupsRelPattern;

use Ivoz\Kam\Domain\Model\TrunksLcrRule\TrunksLcrRule;
use Ivoz\Kam\Domain\Model\TrunksLcrRuleTarget\TrunksLcrRuleTarget;
use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRouting;
use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingDto;
use Ivoz\Provider\Domain\Model\RoutingPatternGroupsRelPattern\RoutingPatternGroupsRelPatternDto;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Provider\Domain\Model\RoutingPatternGroupsRelPattern\RoutingPatternGroupsRelPattern;

class RoutingPatternGroupsRelPatternLifeCycleTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @return RoutingPatternGroupsRelPatternDto
     */
    protected function createDto()
    {
        $routingPatternGroupsRelPatternDto = new RoutingPatternGroupsRelPatternDto();
        $routingPatternGroupsRelPatternDto
            ->setRoutingPatternGroupId(2)
            ->setRoutingPatternId(2);

        return $routingPatternGroupsRelPatternDto;
    }

    protected function prepareDataset()
    {
        $repository = $this->em
            ->getRepository(OutgoingRouting::class);

        $outgoingRouting = $repository->find(1);

        /** @var OutgoingRoutingDto $outgoingRoutingDto */
        $outgoingRoutingDto = $this->entityTools->entityToDto($outgoingRouting);
        $outgoingRoutingDto
            ->setType(OutgoingRouting::TYPE_GROUP)
            ->setRoutingPatternGroupId(2);

        $this->entityTools->persistDto(
            $outgoingRoutingDto,
            $outgoingRouting,
            true
        );

        //Reset changelog
        $this->resetChangelog();
    }

    /**
     * @return RoutingPatternGroupsRelPattern
     */
    protected function addRoutingPatternGroupsRelPattern()
    {
        $this->prepareDataset();
        $routingPatternGroupsRelPatternDto = $this->createDto();

        /** @var RoutingPatternGroupsRelPattern $routingPatternGroupsRelPattern */
        $routingPatternGroupsRelPattern = $this->entityTools
            ->persistDto($routingPatternGroupsRelPatternDto, null, true);

        return $routingPatternGroupsRelPattern;
    }

    protected function updateRoutingPatternGroupsRelPattern()
    {
        $this->prepareDataset();
        $routingPatternGroupsRelPatternRepository = $this->em
            ->getRepository(RoutingPatternGroupsRelPattern::class);

        $routingPatternGroupsRelPattern = $routingPatternGroupsRelPatternRepository->find(1);

        /** @var RoutingPatternGroupsRelPatternDto $routingPatternGroupsRelPatternDto */
        $routingPatternGroupsRelPatternDto = $this->entityTools->entityToDto($routingPatternGroupsRelPattern);

        $routingPatternGroupsRelPatternDto
            ->setRoutingPatternGroupId(2)
            ->setRoutingPatternId(2);

        return $this
            ->entityTools
            ->persistDto($routingPatternGroupsRelPatternDto, $routingPatternGroupsRelPattern, true);
    }

    protected function removeRoutingPatternGroupsRelPattern()
    {
        $this->prepareDataset();
        $routingPatternGroupsRelPatternRepository = $this->em
            ->getRepository(RoutingPatternGroupsRelPattern::class);

        $routingPatternGroupsRelPattern = $routingPatternGroupsRelPatternRepository->find(1);

        $this
            ->entityTools
            ->remove($routingPatternGroupsRelPattern);
    }

    /**
     * @test
     */
    public function it_persists_routingPatternGroupsRelPatterns()
    {
        $routingPatternGroupsRelPattern = $this->em
            ->getRepository(RoutingPatternGroupsRelPattern::class);
        $fixtureRoutingPatternGroupsRelPatterns = $routingPatternGroupsRelPattern->findAll();

        $this->addRoutingPatternGroupsRelPattern();

        $brands = $routingPatternGroupsRelPattern->findAll();
        $this->assertCount(count($fixtureRoutingPatternGroupsRelPatterns) + 1, $brands);
    }

    /**
     * @test
     */
    public function it_triggers_lifecycle_services()
    {
        $this->addRoutingPatternGroupsRelPattern();
        $this->assetChangedEntities([
            RoutingPatternGroupsRelPattern::class,
            TrunksLcrRule::class,
            TrunksLcrRuleTarget::class,
        ]);
    }

    /**
     * @test
     * @expectedException \DomainException
     */
    public function it_triggers_update_lifecycle_services()
    {
        $this->updateRoutingPatternGroupsRelPattern();
    }

    /**
     * @test
     */
    public function it_triggers_remove_lifecycle_services()
    {
        $this->removeRoutingPatternGroupsRelPattern();
        $this->assetChangedEntities([
            RoutingPatternGroupsRelPattern::class,
        ]);
    }

    /////////////////////////////////////////
    ///
    /////////////////////////////////////////

    /**
     * @test
     * @deprecated
     */
    public function it_updates_trunksLcrRule()
    {
        $this->prepareDataset();
        $this->addRoutingPatternGroupsRelPattern();

        /** @var Changelog[] $changelogEntries */
        $changelogEntries = $this->getChangelogByClass(
            TrunksLcrRule::class
        );

        $this->assertCount(1, $changelogEntries);
        $changelog = $changelogEntries[0];

        $this->assertEquals(
            $changelog->getData(),
            [
                'lcr_id' => 1,
                'prefix' => 'aTag+35',
                'from_uri' => '^b1c1$',
                'stopper' => 0,
                'enabled' => 1,
                'routingPatternId' => 2,
                'outgoingRoutingId' => 1,
                'id' => 3,
            ]
        );
    }

    /**
     * @test
     * @deprecated
     */
    public function it_updates_trunksLcrRuleTarget()
    {
        $this->prepareDataset();
        $this->addRoutingPatternGroupsRelPattern();

        /** @var Changelog[] $changelogEntries */
        $changelogEntries = $this->getChangelogByClass(
            TrunksLcrRuleTarget::class
        );

        $this->assertCount(1, $changelogEntries);
        $changelog = $changelogEntries[0];

        $this->assertEquals(
            $changelog->getData(),
            [
                'lcr_id' => 1,
                'priority' => 1,
                'weight' => 1,
                'ruleId' => 3,
                'gwId' => 1,
                'outgoingRoutingId' => 1,
                'id' => 3
            ]
        );
    }
}
