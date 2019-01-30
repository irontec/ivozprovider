<?php

namespace Tests\Provider\HuntGroup;

use Ivoz\Provider\Domain\Model\HuntGroup\HuntGroupRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Provider\Domain\Model\HuntGroup\HuntGroup;

class HuntGroupRepositoryTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @test
     */
    public function its_instantiable()
    {
        /** @var HuntGroupRepository $repository */
        $repository = $this
            ->em
            ->getRepository(HuntGroup::class);

        $this->assertInstanceOf(
            HuntGroupRepository::class,
            $repository
        );
    }
}
