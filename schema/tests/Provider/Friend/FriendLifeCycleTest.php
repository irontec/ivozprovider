<?php

namespace Tests\Provider\Friend;

use Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpoint;
use Ivoz\Ast\Domain\Model\PsIdentify\PsIdentify;
use Ivoz\Provider\Domain\Model\Friend\Friend;
use Ivoz\Provider\Domain\Model\Friend\FriendDto;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;

class FriendLifeCycleTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    protected function addFriend()
    {
        $friendDto = new FriendDto();
        $friendDto
            ->setName('ormTestFriend')
            ->setTransport('udp')
            ->setIp('1.2.3.4')
            ->setDirectConnectivity('yes')
            ->setProxyUserId(1)
            ->setPort('5060')
            ->setPassword('SAG0qd2j6+')
            ->setPriority(2)
            ->setFromDomain('')
            ->setCompanyId(1)
            ->setDomainId(1);

        return $this
            ->entityTools
            ->persistDto($friendDto, null, true);
    }

    protected function updateFriend()
    {
        $friendRepository = $this->em
            ->getRepository(Friend::class);

        $friend = $friendRepository->find(1);

        /** @var FriendDto $friendDto */
        $friendDto = $this->entityTools->entityToDto($friend);

        $friendDto
            ->setName('updatedName');

        return $this
            ->entityTools
            ->persistDto($friendDto, $friend, true);
    }

    protected function removeFriend()
    {
        $friendRepository = $this->em
            ->getRepository(Friend::class);

        $friend = $friendRepository->find(1);

        $this
            ->entityTools
            ->remove($friend);
    }

    /**
     * @test
     */
    public function it_persists_friends()
    {
        $extensionRepository = $this->em
            ->getRepository(Friend::class);
        $fixtureFriends = $extensionRepository->findAll();

        $this->addFriend();

        $extensions = $extensionRepository->findAll();
        $this->assertCount(
            count($fixtureFriends) + 1,
            $extensions
        );

        $this->it_triggers_lifecycle_services();
        $this->new_friend_creates_psEndpoint();
    }

    protected function it_triggers_lifecycle_services()
    {
        $this->assetChangedEntities([
            Friend::class,
            PsEndpoint::class,
            PsIdentify::class,
        ]);
    }

    protected function new_friend_creates_psEndpoint()
    {
        $friendEntries = $this->getChangelogByClass(
            Friend::class
        );

        $this->assertCount(
            1,
            $friendEntries
        );

        $this->assertSubset(
            [ 'name' => 'ormTestFriend' ],
            $friendEntries[0]->getData()
        );
    }

    /**
     * @test
     */
    public function it_triggers_update_lifecycle_services()
    {
        $this->updateFriend();
        $this->assetChangedEntities([
            Friend::class,
            PsEndpoint::class,
            PsIdentify::class,
        ]);
    }

    /**
     * @test
     */
    public function it_triggers_remove_lifecycle_services()
    {
        $this->removeFriend();
        $this->assetChangedEntities([
            Friend::class
        ]);
    }

    ////////////////////////////////////////////
    ///
    ////////////////////////////////////////////

    /**
     * @test
     */
    public function updated_friend_updates_psEndpoint()
    {
        $friend = $this->addFriend();
        $this->enableChangelog();

        $friendDto = $friend->toDto();
        $friendDto->setDirectMediaMethod('invite');

        $this
            ->entityTools
            ->persistDto($friendDto, $friend, true);

        $friendEntries = $this->getChangelogByClass(
            Friend::class
        );

        $this->assertCount(
            1,
            $friendEntries
        );

        $this->assertEquals(
            $friendEntries[0]->getData(),
            [ 'direct_media_method' => 'invite' ]
        );
    }
}
