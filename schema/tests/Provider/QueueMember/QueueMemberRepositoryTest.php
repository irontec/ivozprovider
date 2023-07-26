<?php

namespace Tests\Provider\QueueMember;

use Ivoz\Provider\Domain\Model\QueueMember\QueueMemberInterface;
use Ivoz\Provider\Domain\Model\QueueMember\QueueMemberRepository;
use Ivoz\Provider\Domain\Model\User\User;
use Ivoz\Provider\Domain\Model\User\UserDto;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Ivoz\Provider\Domain\Model\User\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Provider\Domain\Model\QueueMember\QueueMember;

class QueueMemberRepositoryTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    private function prepare_user()
    {
        /** @var UserRepository $repository */
        $repository = $this
            ->em
            ->getRepository(User::class);

        /** @var UserInterface $user */
        $user = $repository->find(1);

        /** @var UserDto $userDto */
        $userDto = $this->entityTools->entityToDto($user);

        // Set User extension (Not done in DataFixtures to avoid dependency loops)
        $userDto->setExtensionId(1);

        $this->entityTools->persistDto(
            $userDto,
            $user
        );
    }

    /**
     * @test
     */
    public function test_runner()
    {
        $this->prepare_user();
        $this->its_instantiable();
        $this->it_finds_by_user_id();
        $this->it_finds_one_by_queue_and_extension();
    }

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

    public function it_finds_by_user_id()
    {
        /** @var QueueMemberRepository $repository */
        $repository = $this
            ->em
            ->getRepository(QueueMember::class);

        $result = $repository->findByUserId(1);

        foreach ($result as $item) {
            $this->assertInstanceOf(
                QueueMemberInterface::class,
                $item
            );
        }
    }

    public function it_finds_one_by_queue_and_extension()
    {
        /** @var QueueMemberRepository $repository */
        $repository = $this
            ->em
            ->getRepository(QueueMember::class);

        $result = $repository->findOneByQueueAndExtension(1, 101);

        $this->assertInstanceOf(
            QueueMemberInterface::class,
            $result
        );
    }
}
