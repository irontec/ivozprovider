<?php

namespace Tests\Provider\Extension;

use Ivoz\Provider\Domain\Model\Extension\Extension;
use Ivoz\Provider\Domain\Model\Extension\ExtensionRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;

class ExtensionRepositoryTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @test
     */
    public function its_instantiable()
    {
        /** @var ExtensionRepository $repository */
        $repository = $this
            ->em
            ->getRepository(Extension::class);

        $this->assertInstanceOf(
            ExtensionRepository::class,
            $repository
        );
    }

    /**
     * @test
     */
    public function it_finds_one_by_company_id()
    {
        /** @var ExtensionRepository $repository */
        $repository = $this
            ->em
            ->getRepository(Extension::class);

        $extensions = $repository->findByCompanyId(1);

        $this->assertInternalType(
            'array',
            $extensions
        );

        $this->assertInstanceOf(
            Extension::class,
            $extensions[0]
        );
    }
}
