<?php

namespace Tests\Provider\CallAclRelMatchList;

use Ivoz\Provider\Domain\Model\CallAclRelMatchList\CallAclRelMatchListRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Provider\Domain\Model\CallAclRelMatchList\CallAclRelMatchList;

class CallAclRelMatchListRepositoryTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @test
     */
    public function its_instantiable()
    {
        /** @var CallAclRelMatchListRepository $repository */
        $repository = $this
            ->em
            ->getRepository(CallAclRelMatchList::class);

        $this->assertInstanceOf(
            CallAclRelMatchListRepository::class,
            $repository
        );
    }
}
