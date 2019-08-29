<?php

namespace Tests\Provider\MatchListPattern;

use Ivoz\Provider\Domain\Model\MatchListPattern\MatchListPatternRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Provider\Domain\Model\MatchListPattern\MatchListPattern;

class MatchListPatternRepositoryTest extends KernelTestCase
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
        /** @var MatchListPatternRepository $repository */
        $repository = $this
            ->em
            ->getRepository(MatchListPattern::class);

        $this->assertInstanceOf(
            MatchListPatternRepository::class,
            $repository
        );
    }
}
