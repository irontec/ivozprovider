<?php

namespace Tests\Provider\PickUpRelUser;

use Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpoint;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Provider\Domain\Model\PickUpRelUser\PickUpRelUser;
use Ivoz\Provider\Domain\Model\PickUpRelUser\PickUpRelUserDto;

class PickUpRelUserLifeCycleTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @return PickUpRelUserDto
     */
    protected function createDto()
    {
        $pickUpRelUserDto = new PickUpRelUserDto();
        $pickUpRelUserDto
            ->setPickUpGroupId(1)
            ->setUserId(1);

        return $pickUpRelUserDto;
    }

    /**
     * @return PickUpRelUser
     */
    protected function addPickUpRelUser()
    {
        $pickUpRelUserDto = $this->createDto();

        /** @var PickUpRelUser $pickUpRelUser */
        $pickUpRelUser = $this->entityTools
            ->persistDto($pickUpRelUserDto, null, true);

        return $pickUpRelUser;
    }

    protected function updatePickUpRelUser()
    {
        $pickUpRelUserRepository = $this->em
            ->getRepository(PickUpRelUser::class);

        $pickUpRelUser = $pickUpRelUserRepository->find(1);

        /** @var PickUpRelUserDto $pickUpRelUserDto */
        $pickUpRelUserDto = $this->entityTools->entityToDto($pickUpRelUser);

        $pickUpRelUserDto
            ->setUserId(2);

        return $this
            ->entityTools
            ->persistDto($pickUpRelUserDto, $pickUpRelUser, true);
    }

    protected function removePickUpRelUser()
    {
        $pickUpRelUser = $this->addPickUpRelUser();
        $this->resetChangelog();

        $this
            ->entityTools
            ->remove($pickUpRelUser);
    }

    /**
     * @test
     */
    public function it_persists_pickUpRelUsers()
    {
        $pickUpRelUser = $this->em
            ->getRepository(PickUpRelUser::class);
        $fixturePickUpRelUsers = $pickUpRelUser->findAll();
        $this->assertCount(1, $fixturePickUpRelUsers);

        $this->addPickUpRelUser();

        $brands = $pickUpRelUser->findAll();
        $this->assertCount(2, $brands);
    }

    /**
     * @test
     */
    public function it_triggers_lifecycle_services()
    {
        $this->addPickUpRelUser();
        $this->assetChangedEntities([
            PickUpRelUser::class,
            PsEndpoint::class
        ]);
    }

    /**
     * @test
     * @expectedException \DomainException
     */
    public function it_triggers_update_lifecycle_services()
    {
        $this->updatePickUpRelUser();
    }

    /**
     * @test
     */
    public function it_triggers_remove_lifecycle_services()
    {
        $this->removePickUpRelUser();
        $this->assetChangedEntities([
            PickUpRelUser::class,
            PsEndpoint::class
        ]);
    }

    ////////////////////////////////////////////////////////
    ///
    ////////////////////////////////////////////////////////

    /**
     * @test
     * @deprecated
     */
    public function it_updates_ps_endpoint()
    {
        $this->addPickUpRelUser();

        /** @var Changelog[] $changelogEntries */
        $changelogEntries = $this->getChangelogByClass(
            PsEndpoint::class
        );

        $this->assertCount(1, $changelogEntries);
        $changelog = $changelogEntries[0];

        $this->assertEquals(
            $changelog->getData(),
            [
                'named_pickup_group' => '1,1'
            ]
        );
    }
}
