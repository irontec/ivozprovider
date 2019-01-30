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
}
