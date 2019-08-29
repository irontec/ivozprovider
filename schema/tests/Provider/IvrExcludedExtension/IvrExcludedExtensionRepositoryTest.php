<?php

namespace Tests\Provider\IvrExcluded;

use Ivoz\Provider\Domain\Model\IvrExcludedExtension\IvrExcludedExtensionRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Provider\Domain\Model\IvrExcludedExtension\IvrExcludedExtension;

class IvrExcludedExtensionRepositoryTest extends KernelTestCase
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
        /** @var IvrExcludedExtensionRepository $repository */
        $repository = $this
            ->em
            ->getRepository(IvrExcludedExtension::class);

        $this->assertInstanceOf(
            IvrExcludedExtensionRepository::class,
            $repository
        );
    }
}
