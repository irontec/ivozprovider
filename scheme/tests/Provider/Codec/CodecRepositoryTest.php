<?php

namespace Tests\Provider\Codec;

use Ivoz\Provider\Domain\Model\Codec\CodecRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Provider\Domain\Model\Codec\Codec;

class CodecRepositoryTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @test
     */
    public function its_instantiable()
    {
        /** @var CodecRepository $repository */
        $repository = $this
            ->em
            ->getRepository(Codec::class);

        $this->assertInstanceOf(
            CodecRepository::class,
            $repository
        );
    }
}