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
}
