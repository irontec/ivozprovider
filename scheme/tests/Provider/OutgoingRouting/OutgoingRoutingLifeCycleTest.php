<?php

namespace Tests\Provider\OutgoingRouting;

use Ivoz\Kam\Domain\Model\TrunksLcrRuleTarget\TrunksLcrRuleTarget;
use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRouting;
use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingDto;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Kam\Domain\Model\TrunksLcrRule\TrunksLcrRule;

class OutgoingRoutingLifeCycleTestLifeCycleTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @return OutgoingRouting
     */
    protected function getOutgoingRoutingDto()
    {
        $outgoingRoutingDto = new OutgoingRoutingDto();
        $outgoingRoutingDto
              ->setType('pattern')
              ->setPriority(2)
              ->setWeight(2)
              ->setBrandId(1)
              ->setCompanyId(1)
              ->setCarrierId(1)
              ->setRoutingPatternId(1);

        return $outgoingRoutingDto;
    }

    /**
     * @return OutgoingRouting
     */
    protected function addOutgoingRouting()
    {
        return $this
            ->entityTools
            ->persistDto($this->getOutgoingRoutingDto(), null, true);
    }


    protected function updateOutgoingRouting()
    {
        $outgoingRoutingRepository = $this->em
            ->getRepository(OutgoingRouting::class);

        $outgoingRouting = $outgoingRoutingRepository->find(1);

        /** @var OutgoingRoutingDto $outgoingRoutingDto */
        $outgoingRoutingDto = $this->entityTools->entityToDto($outgoingRouting);

        $outgoingRoutingDto
            ->setPriority(3);

        return $this
            ->entityTools
            ->persistDto($outgoingRoutingDto, $outgoingRouting, true);
    }

    protected function removeOutgoingRouting()
    {
        $outgoingRoutingRepository = $this->em
            ->getRepository(OutgoingRouting::class);

        $outgoingRouting = $outgoingRoutingRepository->find(1);

        $this
            ->entityTools
            ->remove($outgoingRouting);
    }

    /**
     * @test
     */
    public function it_persists_outgoing_routing()
    {
        $extensionRepository = $this->em
            ->getRepository(OutgoingRouting::class);

        $fixtureOutgoingRoutings = $extensionRepository->findAll();
        $this->assertCount(2, $fixtureOutgoingRoutings);

        $this->addOutgoingRouting();

        $extensions = $extensionRepository->findAll();
        $this->assertCount(
            count($fixtureOutgoingRoutings) + 1,
            $extensions
        );
    }

    /**
     * @test
     */
    public function it_triggers_lifecycle_services()
    {
        $this->addOutgoingRouting();
        $this->assetChangedEntities([
            OutgoingRouting::class,
            TrunksLcrRule::class,
            TrunksLcrRuleTarget::class,
        ]);
    }

    /**
     * @test
     */
    public function it_triggers_update_lifecycle_services()
    {
        $this->updateOutgoingRouting();
        $this->assetChangedEntities([
            OutgoingRouting::class,
            TrunksLcrRule::class,
            TrunksLcrRuleTarget::class,
        ]);
    }

    /**
     * @test
     */
    public function it_triggers_remove_lifecycle_services()
    {
        $this->removeOutgoingRouting();
        $this->assetChangedEntities([
            OutgoingRouting::class,
        ]);
    }

    //////////////////////////////////////////////////////
    ///
    //////////////////////////////////////////////////////

    /**
     * @test
     * @deprecated
     */
    public function new_outgoing_routing_creates_lcr_rules()
    {
        $this->addOutgoingRouting();

        $lcrRules = $this->getChangelogByClass(
            TrunksLcrRule::class
        );

        $this->assertGreaterThan(0, count($lcrRules));
    }

    /**
     * @test
     * @deprecated
     */
    public function new_outgoing_routing_creates_lcr_rule_targets()
    {
        $this->addOutgoingRouting();

        $lcrRuleTargets = $this->getChangelogByClass(
            TrunksLcrRuleTarget::class
        );

        $this->assertGreaterThan(0, count($lcrRuleTargets));
    }
}
