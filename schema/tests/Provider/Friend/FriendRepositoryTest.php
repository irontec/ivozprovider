<?php

namespace Tests\Provider\Friend;

use Ivoz\Provider\Domain\Model\Domain\Domain;
use Ivoz\Provider\Domain\Model\Domain\DomainRepository;
use Ivoz\Provider\Domain\Model\Friend\FriendRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Provider\Domain\Model\Friend\Friend;

class FriendRepositoryTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @test
     */
    public function test_runner()
    {
        $this->its_instantiable();
        $this->it_finds_one_by_name_and_domain();
        $this->it_counts_registrable_devices();
    }

    public function its_instantiable()
    {
        /** @var FriendRepository $repository */
        $repository = $this
            ->em
            ->getRepository(Friend::class);

        $this->assertInstanceOf(
            FriendRepository::class,
            $repository
        );
    }

    public function it_finds_one_by_name_and_domain()
    {
        /** @var FriendRepository $repository */
        $repository = $this
            ->em
            ->getRepository(Friend::class);

        /** @var DomainRepository $domainRepository */
        $domainRepository = $this
            ->em
            ->getRepository(Domain::class);

        /** @var Domain $domain */
        $domain = $domainRepository->find(3);

        $friend = $repository->findOneByNameAndDomain(
            'testFriend',
            $domain
        );

        $this->assertInstanceOf(
            Friend::class,
            $friend
        );
    }

    public function it_counts_registrable_devices()
    {
        /** @var FriendRepository $repository */
        $repository = $this
            ->em
            ->getRepository(Friend::class);

        $num = $repository->countRegistrableDevices([1]);

        $this->assertInternalType(
            'int',
            $num
        );
    }
}
