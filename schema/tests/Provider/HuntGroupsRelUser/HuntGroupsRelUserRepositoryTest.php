<?php

namespace Tests\Provider\HuntGroupsRelUser;

use Ivoz\Provider\Domain\Model\HuntGroupsRelUser\HuntGroupsRelUserRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Provider\Domain\Model\HuntGroupsRelUser\HuntGroupsRelUser;

class HuntGroupsRelUserRepositoryTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @test
     */
    public function test_runner()
    {
        $this->its_instantiable();
        $this->it_finds_user_ids_by_hunt_group_id();
    }

    public function its_instantiable()
    {
        /** @var HuntGroupsRelUserRepository $repository */
        $repository = $this
            ->em
            ->getRepository(HuntGroupsRelUser::class);

        $this->assertInstanceOf(
            HuntGroupsRelUserRepository::class,
            $repository
        );
    }

    public function it_finds_user_ids_by_hunt_group_id()
    {
        /** @var HuntGroupsRelUserRepository $repository */
        $repository = $this
            ->em
            ->getRepository(HuntGroupsRelUser::class);

        $userIds = $repository->findUserIdsInHuntGroup(
            1
        );

        $this->assertIsArray(
            $userIds
        );

        $this->assertIsInt(
            $userIds[0]
        );
    }
}
