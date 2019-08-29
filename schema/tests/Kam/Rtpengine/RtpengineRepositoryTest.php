<?php

namespace Tests\Provider\Rtpengine;

use Ivoz\Kam\Domain\Model\Rtpengine\RtpengineInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Kam\Domain\Model\Rtpengine\Rtpengine;
use Ivoz\Kam\Domain\Model\Rtpengine\RtpengineRepository;

class RtpengineRepositoryTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @test
     */
    public function test_runner()
    {
        $this->its_instantiable();
    }

    public function its_instantiable()
    {
        /** @var RtpengineRepository $repository */
        $repository = $this
            ->em
            ->getRepository(Rtpengine::class);

        $this->assertInstanceOf(
            RtpengineRepository::class,
            $repository
        );
    }
}
