<?php

namespace Tests\Provider\PickUpGroup;

use Ivoz\Provider\Domain\Model\PickUpGroup\PickUpGroupRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Provider\Domain\Model\PickUpGroup\PickUpGroup;

class PickUpGroupRepositoryTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @test
     */
    public function its_instantiable()
    {
        /** @var PickUpGroupRepository $repository */
        $repository = $this
            ->em
            ->getRepository(PickUpGroup::class);

        $this->assertInstanceOf(
            PickUpGroupRepository::class,
            $repository
        );
    }
}