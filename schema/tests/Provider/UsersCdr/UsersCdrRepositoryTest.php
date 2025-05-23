<?php

namespace Tests\Provider\UsersCdr;

use Ivoz\Provider\Domain\Model\UsersCdr\UsersCdr;
use Ivoz\Provider\Domain\Model\UsersCdr\UsersCdrInterface;
use Ivoz\Provider\Domain\Model\UsersCdr\UsersCdrRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;

class UsersCdrRepositoryTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @test
     */
    public function test_runner()
    {
        $this->it_finds_by_kamUsersCdrId();
        $this->it_find_last_by_callid();
    }

    public function it_finds_by_kamUsersCdrId()
    {
        /** @var UsersCdrRepository $repository */
        $repository = $this
            ->em
            ->getRepository(UsersCdr::class);

        $cdr = $repository
            ->findByKamUsersCdrId(2);

        $this->assertInstanceOf(
            UsersCdrInterface::class,
            $cdr
        );
    }

    public function it_find_last_by_callid()
    {
        /** @var UsersCdrRepository $repository */
        $repository = $this
            ->em
            ->getRepository(UsersCdr::class);

        $cdr = $repository
            ->findLastByCallidAndDirection(
                '9297bdde-309cd48f@10.10.1.124',
                UsersCdrInterface::DIRECTION_OUTBOUND
            );

        $this->assertInstanceOf(
            UsersCdrInterface::class,
            $cdr,
        );
    }
}
