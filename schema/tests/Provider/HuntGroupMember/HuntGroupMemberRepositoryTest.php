<?php

namespace Tests\Provider\HuntGroupMember;

use Ivoz\Provider\Domain\Model\HuntGroupMember\HuntGroupMember;
use Ivoz\Provider\Domain\Model\HuntGroupMember\HuntGroupMemberRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;

class HuntGroupMemberRepositoryTest extends KernelTestCase
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
        /** @var HuntGroupMemberRepository $repository */
        $repository = $this
            ->em
            ->getRepository(HuntGroupMember::class);

        $this->assertInstanceOf(
            HuntGroupMemberRepository::class,
            $repository
        );
    }

    public function it_finds_user_ids_by_hunt_group_id()
    {
        /** @var HuntGroupMemberRepository $repository */
        $repository = $this
            ->em
            ->getRepository(HuntGroupMember::class);

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
