<?php

namespace Tests\Provider\ConditionalRoutesCondition;

use Ivoz\Provider\Domain\Model\ConditionalRoutesCondition\ConditionalRoutesConditionRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Provider\Domain\Model\ConditionalRoutesCondition\ConditionalRoutesCondition;

class ConditionalRoutesConditionRepositoryTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @test
     */
    public function its_instantiable()
    {
        /** @var ConditionalRoutesConditionRepository $repository */
        $repository = $this
            ->em
            ->getRepository(ConditionalRoutesCondition::class);

        $this->assertInstanceOf(
            ConditionalRoutesConditionRepository::class,
            $repository
        );
    }
}
