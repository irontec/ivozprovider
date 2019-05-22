<?php

namespace Tests\Provider\RoutingTag;

use Ivoz\Provider\Domain\Model\RoutingTag\RoutingTagRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Provider\Domain\Model\RoutingTag\RoutingTag;

class RoutingTagRepositoryTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @test
     */
    public function its_instantiable()
    {
        /** @var RoutingTagRepository $repository */
        $repository = $this
            ->em
            ->getRepository(RoutingTag::class);

        $this->assertInstanceOf(
            RoutingTagRepository::class,
            $repository
        );
    }
}
