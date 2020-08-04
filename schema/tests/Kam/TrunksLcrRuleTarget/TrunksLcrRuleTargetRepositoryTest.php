<?php

namespace Tests\Provider\TrunksLcrRuleTarget;

use Ivoz\Kam\Domain\Model\TrunksLcrGateway\TrunksLcrGateway;
use Ivoz\Kam\Domain\Model\TrunksLcrRule\TrunksLcrRule;
use Ivoz\Kam\Domain\Model\TrunksLcrRuleTarget\TrunksLcrRuleTargetInterface;
use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRouting;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Kam\Domain\Model\TrunksLcrRuleTarget\TrunksLcrRuleTarget;
use Ivoz\Kam\Domain\Model\TrunksLcrRuleTarget\TrunksLcrRuleTargetRepository;

class TrunksLcrRuleTargetRepositoryTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @test
     */
    public function test_runner()
    {
        $this->its_instantiable();
        $this->it_finds_ruleTargets();
        $this->it_finds_orphan_lcr_rule_targets();
    }

    public function its_instantiable()
    {
        /** @var TrunksLcrRuleTargetRepository $repository */
        $repository = $this
            ->em
            ->getRepository(TrunksLcrRuleTarget::class);

        $this->assertInstanceOf(
            TrunksLcrRuleTargetRepository::class,
            $repository
        );
    }

    public function it_finds_ruleTargets()
    {
        /** @var TrunksLcrRuleTargetRepository $repository */
        $repository = $this
            ->em
            ->getRepository(TrunksLcrRuleTarget::class);

        $result = $repository->findRuleTarget(
            $this->em->getReference(OutgoingRouting::class, 2),
            $this->em->getReference(TrunksLcrRule::class, 1),
            $this->em->getReference(TrunksLcrGateway::class, 1)
        );

        $this->assertInstanceOf(
            TrunksLcrRuleTargetInterface::class,
            $result
        );
    }

    public function it_finds_orphan_lcr_rule_targets()
    {
        /** @var TrunksLcrRuleTargetRepository $repository */
        $repository = $this
            ->em
            ->getRepository(TrunksLcrRuleTarget::class);

        $results = $repository->findOrphanLcrRuleTargets(
            $this->em->getReference(OutgoingRouting::class, 1)
        );

        $this->assertIsArray(
            $results
        );
    }
}
