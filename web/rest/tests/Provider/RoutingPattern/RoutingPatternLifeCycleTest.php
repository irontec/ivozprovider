<?php

namespace Tests\Provider\RoutingPattern;

use Ivoz\Kam\Domain\Model\TrunksLcrRule\TrunksLcrRule;
use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRouting;
use Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPattern;
use Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternDto;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;

class RoutingPatternLifeCycleTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @return OutgoingRouting
     */
    protected function getRoutingPatternDto()
    {
        $routingPatternDto = new RoutingPatternDto();
        $routingPatternDto
            ->setPrefix('+11')
            ->setNameEn('en')
            ->setNameEs('es')
            ->setDescriptionEn('en')
            ->setDescriptionEs('es')
            ->setBrandId(1);

        return $routingPatternDto;
    }

    /**
     * @return OutgoingRouting
     */
    protected function addRoutingPattern()
    {
        return $this
            ->entityTools
            ->persistDto($this->getRoutingPatternDto(), null, true);
    }

    /**
     * @test
     */
    public function it_persists_routing_patterns()
    {
        $routingPatternRepository = $this->em
            ->getRepository(RoutingPattern::class);

        $fixtureRoutingPattern = $routingPatternRepository->findAll();
        $this->assertCount(2, $fixtureRoutingPattern);

        $this->addRoutingPattern();

        $routingPatterns = $routingPatternRepository->findAll();
        $this->assertCount(
            count($fixtureRoutingPattern) + 1,
            $routingPatterns
        );
    }

    /**
     * @test
     */
    public function updated_prefix_updates_trunks_lcr_rule()
    {
        $outgoingRoutingRepository = $this->em
            ->getRepository(OutgoingRouting::class);

        /** @var OutgoingRouting $outgoingRouting */
        $outgoingRouting = $outgoingRoutingRepository->findOneBy(
            ['routingPattern' => 1]
        );

        $routingPattern = $outgoingRouting->getRoutingPattern();
        $routingPatternDto = $this->entityTools->entityToDto($routingPattern);

        $routingPatternDto->setPrefix('+321');
        $this->entityTools->persistDto(
            $routingPatternDto,
            $routingPattern,
            true
        );

        $lcrRules = $this->getChangelogByClass(
            TrunksLcrRule::class
        );

        $this->assertGreaterThan(0, count($lcrRules));
    }
}