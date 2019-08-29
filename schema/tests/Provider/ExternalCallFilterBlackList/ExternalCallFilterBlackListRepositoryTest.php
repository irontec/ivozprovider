<?php

namespace Tests\Provider\ExternalCallFilterBlackList;

use Ivoz\Provider\Domain\Model\ExternalCallFilterBlackList\ExternalCallFilterBlackListRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Provider\Domain\Model\ExternalCallFilterBlackList\ExternalCallFilterBlackList;

class ExternalCallFilterBlackListRepositoryTest extends KernelTestCase
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
        /** @var ExternalCallFilterBlackListRepository $repository */
        $repository = $this
            ->em
            ->getRepository(ExternalCallFilterBlackList::class);

        $this->assertInstanceOf(
            ExternalCallFilterBlackListRepository::class,
            $repository
        );
    }
}
