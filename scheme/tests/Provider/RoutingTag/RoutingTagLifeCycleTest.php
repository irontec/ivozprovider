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
     * @return RoutingTagDto
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

    protected function addRoutingTag()
    {
        return $this
            ->entityTools
            ->persistDto($this->getRoutingTagDto(), null, true);
    }

    protected function updateRoutingTag()
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
    }

    protected function removeRoutingTag()
    {
        $routingTagRepository = $this->em
            ->getRepository(RoutingTag::class);

        $routingTag = $routingTagRepository->find(1);

        return $this
            ->entityTools
            ->remove($routingTag);
    }

    /**
     * @test
     */
    public function it_persists_routing_tags()
    {
        $routingTagRepository = $this->em
            ->getRepository(RoutingTag::class);

        $fixtureRoutingTag = $routingTagRepository->findAll();

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
    public function it_triggers_lifecycle_services()
    {
        $this->addRoutingTag();
        $this->assetChangedEntities([
            RoutingTag::class
        ]);
    }

    /**
     * @test
     */
    public function it_triggers_update_lifecycle_services()
    {
        $this->updateRoutingTag();
        $this->assetChangedEntities([
            RoutingTag::class,
            TrunksLcrRule::class
        ]);
    }


    /**
     * @test
     */
    public function it_triggers_remove_lifecycle_services()
    {
        $this->removeRoutingTag();
        $this->assetChangedEntities([
            RoutingTag::class,
        ]);
    }
}
