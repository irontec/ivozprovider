<?php

namespace Tests\Provider\User;

use Ivoz\Provider\Domain\Model\Administrator\Administrator;
use Ivoz\Provider\Domain\Model\Administrator\AdministratorRepository;
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
    public function test_runner()
    {
        $this->it_finds_by_bossAssistantId();
        $this->it_finds_supervised_userIds_by_admin();
        $this->it_gets_user_assistant_candidates();
        $this->it_gets_available_voicemails();
        $this->it_users_by_company_excluding_ids();
        $this->it_searchs_one_by_company_and_name();
        $this->it_searchs_one_by_email();
    }

    public function it_finds_by_bossAssistantId()
    {
        /** @var UserRepository $repository */
        $repository = $this
            ->em
            ->getRepository(User::class);

        $user = $repository
            ->findByBossAssistantId(1);

        $this->assertIsArray(
            $user
        );

        $this->assertInstanceOf(
            UserInterface::class,
            $user[0]
        );
    }

    public function it_finds_supervised_userIds_by_admin()
    {
        /** @var AdministratorRepository $adminRepository */
        $adminRepository = $this
            ->em
            ->getRepository(Administrator::class);

        /** @var UserRepository $repository */
        $repository = $this
            ->em
            ->getRepository(User::class);

        $admin = $adminRepository->find(2);

        $ids = $repository->getSupervisedUserIdsByAdmin($admin);

        $this->assertIsArray(
            $ids
        );

        $this->assertIsInt(
            $ids[0]
        );
    }

    public function it_gets_user_assistant_candidates()
    {
        /** @var UserRepository $userRepository */
        $userRepository = $this->em
            ->getRepository(User::class);

        $users = $userRepository
            ->getUserAssistantCandidates(
                $userRepository->find(2)
            );

        $this->assertIsArray(
            $users
        );

        $this->assertInstanceOf(
            User::class,
            $users[0]
        );
    }

    public function it_gets_available_voicemails()
    {
        /** @var UserRepository $userRepository */
        $userRepository = $this->em
            ->getRepository(User::class);

        $users = $userRepository
            ->getAvailableVoicemails(
                $userRepository->find(1)
            );

        $this->assertIsArray(
            $users
        );

        $this->assertInstanceOf(
            User::class,
            $users[0]
        );
    }

    public function it_searchs_one_by_company_and_name()
    {
        /** @var UserRepository $userRepository */
        $userRepository = $this->em
            ->getRepository(User::class);

        $user = $userRepository
            ->findOneByCompanyAndName(
                1,
                'Alice',
                'Allison'
            );

        $this->assertInstanceOf(
            User::class,
            $user
        );
    }

    public function it_users_by_company_excluding_ids()
    {
        /** @var UserRepository $userRepository */
        $userRepository = $this->em
            ->getRepository(User::class);

        $allUsers = $userRepository
            ->findCompanyUsersExcludingIds(
                1,
                [999999999]
            );

        $users = $userRepository
            ->findCompanyUsersExcludingIds(
                1,
                [1]
            );

        $this->assertIsArray(
            $users
        );

        $this->assertInstanceOf(
            User::class,
            $users[0]
        );

        $this->assertNotEquals(
            count($allUsers),
            count($users)
        );
    }

    public function it_searchs_one_by_email()
    {
        /** @var UserRepository $userRepository */
        $userRepository = $this->em
            ->getRepository(User::class);

        $user = $userRepository
            ->findOneByEmail(
                'alice@democompany.com'
            );

        $this->assertInstanceOf(
            User::class,
            $user
        );
    }
}
