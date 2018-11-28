<?php

namespace Tests\Provider\CallAcl;

use Ivoz\Provider\Domain\Model\CallAcl\CallAclRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Provider\Domain\Model\CallAcl\CallAcl;

class CallAclRepositoryTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @test
     */
    public function its_instantiable()
    {
        /** @var CallAclRepository $repository */
        $repository = $this
            ->em
            ->getRepository(CallAcl::class);

        $this->assertInstanceOf(
            CallAclRepository::class,
            $repository
        );
    }
}