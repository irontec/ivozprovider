<?php

namespace Tests\Provider\RoutingTag;

use Ivoz\Kam\Domain\Model\TrunksLcrRule\TrunksLcrRule;
use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRouting;
use Ivoz\Provider\Domain\Model\RoutingTag\RoutingTag;
use Ivoz\Provider\Domain\Model\RoutingTag\RoutingTagDto;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;

class RoutingTagLifeCycleTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @return OutgoingRouting
     */
    protected function getRoutingTagDto()
    {
        $routingTagDto = new RoutingTagDto();
        $routingTagDto
            ->setName('1')
            ->setTag('2')
            ->setBrandId(1);

        return $routingTagDto;
    }

    /**
     * @return OutgoingRouting
     */
    protected function addRoutingTag()
    {
        return $this
            ->entityTools
            ->persistDto($this->getRoutingTagDto(), null, true);
    }

    /**
     * @test
     */
    public function it_persists_routing_tags()
    {
        $routingTagRepository = $this->em
            ->getRepository(RoutingTag::class);

        $fixtureRoutingTag = $routingTagRepository->findAll();
        $this->assertCount(1, $fixtureRoutingTag);

        $this->addRoutingTag();

        $routingTags = $routingTagRepository->findAll();
        $this->assertCount(
            count($fixtureRoutingTag) + 1,
            $routingTags
        );
    }

    /**
     * @test
     */
    public function updated_tag_updates_trunks_lcr_rule()
    {
        $outgoingRoutingRepository = $this->em
            ->getRepository(OutgoingRouting::class);

        /** @var OutgoingRouting $outgoingRouting */
        $outgoingRouting = $outgoingRoutingRepository->findOneBy(
            ['routingTag' => 1]
        );

        $routingTag = $outgoingRouting->getRoutingTag();
        $routingTagDto = $this->entityTools->entityToDto($routingTag);

        $routingTagDto->setTag('Something');
        $this->entityTools->persistDto(
            $routingTagDto,
            $routingTag,
            true
        );

        $lcrRules = $this->getChangelogByClass(
            TrunksLcrRule::class
        );

        $this->assertGreaterThan(0, count($lcrRules));
    }
}