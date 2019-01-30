<?php

namespace Tests\Provider\FriendsPattern;

use Ivoz\Provider\Domain\Model\FriendsPattern\FriendsPatternRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Provider\Domain\Model\FriendsPattern\FriendsPattern;

class FriendsPatternRepositoryTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @test
     */
    public function its_instantiable()
    {
        /** @var FriendsPatternRepository $repository */
        $repository = $this
            ->em
            ->getRepository(FriendsPattern::class);

        $this->assertInstanceOf(
            FriendsPatternRepository::class,
            $repository
        );
    }
}
