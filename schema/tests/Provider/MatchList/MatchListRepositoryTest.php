<?php

namespace Tests\Provider\MatchList;

use Ivoz\Provider\Domain\Model\MatchList\MatchListRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Provider\Domain\Model\MatchList\MatchList;

class MatchListRepositoryTest extends KernelTestCase
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
        /** @var MatchListRepository $repository */
        $repository = $this
            ->em
            ->getRepository(MatchList::class);

        $this->assertInstanceOf(
            MatchListRepository::class,
            $repository
        );
    }
}
