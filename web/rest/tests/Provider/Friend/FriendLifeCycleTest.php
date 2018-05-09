<?php

namespace Tests\Provider\Friend;

use Ivoz\Provider\Domain\Model\Friend\Friend;
use Ivoz\Provider\Domain\Model\Friend\FriendDto;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;

class FriendLifeCycleTestLifeCycleTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @return Friend
     */
    protected function addFriend()
    {
        $friendDto = new FriendDto();
        $friendDto
            ->setName('ormTestFriend')
            ->setTransport('udp')
            ->setIp('')
            ->setPort('5060')
            ->setPassword('SAG0qd2j6+')
            ->setPriority(2)
            ->setFromDomain('')
            ->setCompanyId(1)
            ->setDomainId(1);

        return $this
            ->entityPersister
            ->persistDto($friendDto, null, true);
    }

    /**
     * @test
     */
    public function it_persists_friends()
    {
        $extensionRepository = $this->em
            ->getRepository(Friend::class);

        $fixtureFriends = $extensionRepository->findAll();
        $this->assertCount(1, $fixtureFriends);

        $this->addFriend();

        $extensions = $extensionRepository->findAll();
        $this->assertCount(
            count($fixtureFriends) + 1,
            $extensions
        );
    }

    /**
     * @test
     */
    public function new_friend_creates_psEndpoint()
    {
        $this->addFriend();

        $friendEntries = $this->getChangelogByClass(
            Friend::class
        );

        $this->assertCount(
            1,
            $friendEntries
        );

        $this->assertArraySubset(
            [ 'name' => 'ormTestFriend' ],
            $friendEntries[0]->getData()
        );
    }

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
            ->entityPersister
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