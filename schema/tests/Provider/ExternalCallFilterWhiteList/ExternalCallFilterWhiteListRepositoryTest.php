<?php

namespace Tests\Provider\ExternalCallFilterWhite;

use Ivoz\Provider\Domain\Model\ExternalCallFilterWhiteList\ExternalCallFilterWhiteListRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Provider\Domain\Model\ExternalCallFilterWhiteList\ExternalCallFilterWhiteList;

class ExternalCallFilterWhiteListRepositoryTest extends KernelTestCase
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
        /** @var ExternalCallFilterWhiteListRepository $repository */
        $repository = $this
            ->em
            ->getRepository(ExternalCallFilterWhiteList::class);

        $this->assertInstanceOf(
            ExternalCallFilterWhiteListRepository::class,
            $repository
        );
    }
}
