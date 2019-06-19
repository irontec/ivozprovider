<?php

namespace Tests\Provider\User;

use Ivoz\Provider\Domain\Model\User\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Provider\Domain\Model\User\User;
use Ivoz\Provider\Domain\Model\User\UserInterface;

class UserRepositoryTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @test
     */
    public function it_finds_by_bossAssistantId()
    {
        /** @var UserRepository $repository */
        $repository = $this
            ->em
            ->getRepository(User::class);

        $user = $repository
            ->findByBossAssistantId(1);

        $this->assertInternalType(
            'array',
            $user
        );

        $this->assertInstanceOf(
            UserInterface::class,
            $user[0]
        );
    }

    /**
     * @test
     */
    public function it_gets_user_assistant_candidates()
    {
        /** @var UserRepository $userRepository */
        $userRepository = $this->em
            ->getRepository(User::class);

        $users = $userRepository
            ->getUserAssistantCandidates(
                $userRepository->find(2)
            );

        $this->assertInternalType(
            'array',
            $users
        );

        $this->assertInstanceOf(
            User::class,
            $users[0]
        );
    }

    /**
     * @test
     */
    public function it_gets_available_voicemails()
    {
        /** @var UserRepository $userRepository */
        $userRepository = $this->em
            ->getRepository(User::class);

        $users = $userRepository
            ->getAvailableVoicemails(
                $userRepository->find(1)
            );

        $this->assertInternalType(
            'array',
            $users
        );

        $this->assertInstanceOf(
            User::class,
            $users[0]
        );
    }
}
