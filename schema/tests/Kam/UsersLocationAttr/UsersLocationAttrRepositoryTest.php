<?php

namespace Tests\Provider\UsersLocationAttr;

use Ivoz\Kam\Domain\Model\UsersLocationAttr\UsersLocationAttrInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Kam\Domain\Model\UsersLocationAttr\UsersLocationAttr;
use Ivoz\Kam\Domain\Model\UsersLocationAttr\UsersLocationAttrRepository;

class UsersLocationAttrRepositoryTest extends KernelTestCase
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
        /** @var UsersLocationAttrRepository $repository */
        $repository = $this
            ->em
            ->getRepository(UsersLocationAttr::class);

        $this->assertInstanceOf(
            UsersLocationAttrRepository::class,
            $repository
        );
    }
}
