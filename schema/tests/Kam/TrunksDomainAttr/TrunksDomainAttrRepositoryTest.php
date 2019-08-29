<?php

namespace Tests\Provider\TrunksDomainAttr;

use Ivoz\Kam\Domain\Model\TrunksDomainAttr\TrunksDomainAttrInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Kam\Domain\Model\TrunksDomainAttr\TrunksDomainAttr;
use Ivoz\Kam\Domain\Model\TrunksDomainAttr\TrunksDomainAttrRepository;

class TrunksDomainAttrRepositoryTest extends KernelTestCase
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
        /** @var TrunksDomainAttrRepository $repository */
        $repository = $this
            ->em
            ->getRepository(TrunksDomainAttr::class);

        $this->assertInstanceOf(
            TrunksDomainAttrRepository::class,
            $repository
        );
    }
}
