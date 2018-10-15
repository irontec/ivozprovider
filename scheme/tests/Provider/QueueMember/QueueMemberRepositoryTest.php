<?php

namespace Tests\Provider\QueueMember;

use Ivoz\Provider\Domain\Model\QueueMember\QueueMemberRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Provider\Domain\Model\QueueMember\QueueMember;

class QueueMemberRepositoryTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @test
     */
    public function its_instantiable()
    {
        /** @var QueueMemberRepository $repository */
        $repository = $this
            ->em
            ->getRepository(QueueMember::class);

        $this->assertInstanceOf(
            QueueMemberRepository::class,
            $repository
        );
    }
}