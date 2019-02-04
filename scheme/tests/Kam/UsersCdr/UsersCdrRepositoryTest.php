<?php

namespace Tests\Provider\UsersCdr;

use Ivoz\Kam\Domain\Model\UsersCdr\UsersCdrInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Kam\Domain\Model\UsersCdr\UsersCdr;
use Ivoz\Kam\Domain\Model\UsersCdr\UsersCdrRepository;

class UsersCdrRepositoryTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @test
     */
    public function its_instantiable()
    {
        /** @var UsersCdrRepository $repository */
        $repository = $this
            ->em
            ->getRepository(UsersCdr::class);

        $this->assertInstanceOf(
            UsersCdrRepository::class,
            $repository
        );
    }

    /**
     * @test
     */
    public function it_counts_by_userId()
    {
        /** @var UsersCdrRepository $repository */
        $repository = $this
            ->em
            ->getRepository(UsersCdr::class);

        $result = $repository
            ->countByUserId(1);

        $this->AssertEquals(
            1,
            $result
        );
    }

    /**
     * @test
     */
    public function it_finds_by_callid()
    {
        /** @var UsersCdrRepository $repository */
        $repository = $this
            ->em
            ->getRepository(UsersCdr::class);

        $result = $repository
            ->findByCallid('9297bdde-309cd48f@10.10.1.123');

        $this->assertCount(
            1,
            $result
        );

        $this->assertInstanceOf(
            UsersCdrInterface::class,
            $result[0]
        );
    }

    /**
     * @test
     */
    public function it_finds_one_by_callid()
    {
        /** @var UsersCdrRepository $repository */
        $repository = $this
            ->em
            ->getRepository(UsersCdr::class);

        $result = $repository
            ->findOneByCallid('9297bdde-309cd48f@10.10.1.123');

        $this->assertInstanceOf(
            UsersCdrInterface::class,
            $result
        );
    }
}
