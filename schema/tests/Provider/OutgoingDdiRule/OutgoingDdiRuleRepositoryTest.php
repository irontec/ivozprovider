<?php

namespace Tests\Provider\OutgoingDdiRule;

use Ivoz\Provider\Domain\Model\OutgoingDdiRule\OutgoingDdiRuleRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Provider\Domain\Model\OutgoingDdiRule\OutgoingDdiRule;

class OutgoingDdiRuleRepositoryTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @test
     */
    public function its_instantiable()
    {
        /** @var OutgoingDdiRuleRepository $repository */
        $repository = $this
            ->em
            ->getRepository(OutgoingDdiRule::class);

        $this->assertInstanceOf(
            OutgoingDdiRuleRepository::class,
            $repository
        );
    }
}
