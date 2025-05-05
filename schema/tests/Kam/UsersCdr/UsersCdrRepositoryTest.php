<?php

namespace Tests\Kam\UsersCdr;

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
    public function test_runner()
    {
        $this->its_instantiable();
        $this->it_counts_by_userId();
        $this->it_counts_inbound_calls_by_userId();
        $this->it_counts_outbound_calls_by_userId();
        $this->it_finds_unparsedCalls();
    }

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

    public function it_counts_by_userId()
    {
        /** @var UsersCdrRepository $repository */
        $repository = $this
            ->em
            ->getRepository(UsersCdr::class);

        $result = $repository
            ->countByUserId(1);

        $this->AssertEquals(
            3,
            $result
        );
    }

    public function it_counts_inbound_calls_by_userId()
    {
        /** @var UsersCdrRepository $repository */
        $repository = $this
            ->em
            ->getRepository(UsersCdr::class);

        $result = $repository
            ->countInboundCallsInLastMonthByUser(1);

        $this->AssertEquals(
            0,
            $result
        );
    }

    public function it_counts_outbound_calls_by_userId()
    {
        /** @var UsersCdrRepository $repository */
        $repository = $this
            ->em
            ->getRepository(UsersCdr::class);

        $result = $repository
            ->countOutboundCallsInLastMonthByUser(1);

        $this->AssertEquals(
            1,
            $result
        );
    }

    public function it_finds_unparsedCalls()
    {
        /** @var \Ivoz\Kam\Domain\Model\UsersCdr\UsersCdrRepository $repository */
        $repository = $this
            ->em
            ->getRepository(\Ivoz\Kam\Domain\Model\UsersCdr\UsersCdr::class);

        $result = $repository
            ->getUnparsedCallsGeneratorWithoutOffset(1000);

        $this->assertInstanceOf(
            \Generator::class,
            $result
        );

        foreach ($result as $item) {
            $this->assertInstanceOf(
                UsersCdrInterface::class,
                $item[0]
            );
        }
    }
}
