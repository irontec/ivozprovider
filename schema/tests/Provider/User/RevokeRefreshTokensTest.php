<?php

namespace Tests\Provider\User;

use Ivoz\Provider\Domain\Model\User\User;
use Ivoz\Provider\Domain\Model\User\UserDto;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;

class RevokeRefreshTokensTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    private const ALICE_EMAIL = 'alice@democompany.com';
    private const BOB_EMAIL = 'bob@democompany.com';
    private const DANA_EMAIL = 'dana@democompany.com';

    /**
     * @test
     */
    public function disabling_a_user_revokes_only_its_refresh_tokens()
    {
        $this->updateUser(self::ALICE_EMAIL, fn (UserDto $dto) => $dto->setActive(false));

        $this->assertSame(0, $this->countRefreshTokens(self::ALICE_EMAIL));
        $this->assertSame(1, $this->countRefreshTokens(self::BOB_EMAIL));
    }

    /**
     * @test
     */
    public function changing_the_password_revokes_only_its_refresh_tokens()
    {
        $this->updateUser(self::ALICE_EMAIL, fn (UserDto $dto) => $dto->setPass('N3wPassw0rd'));

        $this->assertSame(0, $this->countRefreshTokens(self::ALICE_EMAIL));
        $this->assertSame(1, $this->countRefreshTokens(self::BOB_EMAIL));
    }

    /**
     * @test
     */
    public function changing_the_email_revokes_previous_email_refresh_tokens()
    {
        $this->updateUser(self::ALICE_EMAIL, fn (UserDto $dto) => $dto->setEmail('alice.new@democompany.com'));

        $this->assertSame(0, $this->countRefreshTokens(self::ALICE_EMAIL));
        $this->assertSame(1, $this->countRefreshTokens(self::BOB_EMAIL));
    }

    /**
     * @test
     */
    public function enabling_a_user_keeps_refresh_tokens()
    {
        $this->updateUser(self::DANA_EMAIL, fn (UserDto $dto) => $dto->setActive(true));

        $this->assertSame(1, $this->countRefreshTokens(self::DANA_EMAIL));
    }

    /**
     * @test
     */
    public function changing_other_fields_keeps_refresh_tokens()
    {
        $this->updateUser(self::ALICE_EMAIL, fn (UserDto $dto) => $dto->setName('Alicia'));

        $this->assertSame(1, $this->countRefreshTokens(self::ALICE_EMAIL));
    }

    /**
     * @test
     */
    public function removing_a_user_revokes_only_its_refresh_tokens()
    {
        $this->entityTools->remove(
            $this->findUser(self::ALICE_EMAIL)
        );

        $this->assertSame(0, $this->countRefreshTokens(self::ALICE_EMAIL));
        $this->assertSame(1, $this->countRefreshTokens(self::BOB_EMAIL));
    }

    private function updateUser(string $email, callable $changeDto): void
    {
        $user = $this->findUser($email);

        /** @var UserDto $userDto */
        $userDto = $this->entityTools->entityToDto($user);
        $changeDto($userDto);

        $this->entityTools->persistDto($userDto, $user, true);
    }

    private function findUser(string $email): User
    {
        return $this->em->getRepository(User::class)->findOneBy([
            'email' => $email
        ]);
    }

    private function countRefreshTokens(string $username): int
    {
        return (int) $this->em->getConnection()->fetchOne(
            'SELECT COUNT(*) FROM refresh_tokens WHERE username = ?',
            [$username]
        );
    }
}
