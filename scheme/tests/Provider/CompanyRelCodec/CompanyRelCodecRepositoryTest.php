<?php

namespace Tests\Provider\CompanyRelCodec;

use Ivoz\Provider\Domain\Model\CompanyRelCodec\CompanyRelCodecRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Provider\Domain\Model\CompanyRelCodec\CompanyRelCodec;

class CompanyRelCodecRepositoryTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @test
     */
    public function its_instantiable()
    {
        /** @var CompanyRelCodecRepository $repository */
        $repository = $this
            ->em
            ->getRepository(CompanyRelCodec::class);

        $this->assertInstanceOf(
            CompanyRelCodecRepository::class,
            $repository
        );
    }
}
