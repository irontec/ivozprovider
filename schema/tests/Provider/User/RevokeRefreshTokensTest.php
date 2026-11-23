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
    public function test_runner()
    {
        $this->it_keeps_refresh_tokens_when_other_fields_change();
        $this->it_keeps_refresh_tokens_when_user_gets_enabled();
        $this->it_revokes_refresh_tokens_when_user_gets_disabled();
        $this->it_revokes_refresh_tokens_when_password_changes();
        $this->it_revokes_previous_email_refresh_tokens_when_email_changes();
        $this->it_revokes_refresh_tokens_when_user_is_removed();
    }

    private function it_keeps_refresh_tokens_when_other_fields_change()
    {
        $this->updateUser(self::ALICE_EMAIL, fn (UserDto $dto) => $dto->setName('Alicia'));

        $this->assertSame(1, $this->countRefreshTokens(self::ALICE_EMAIL));
    }

    private function it_keeps_refresh_tokens_when_user_gets_enabled()
    {
        $this->updateUser(self::DANA_EMAIL, fn (UserDto $dto) => $dto->setActive(true));

        $this->assertSame(1, $this->countRefreshTokens(self::DANA_EMAIL));
    }

    private function it_revokes_refresh_tokens_when_user_gets_disabled()
    {
        $this->updateUser(self::ALICE_EMAIL, fn (UserDto $dto) => $dto->setActive(false));

        $this->assertSame(0, $this->countRefreshTokens(self::ALICE_EMAIL));
        $this->assertSame(1, $this->countRefreshTokens(self::BOB_EMAIL));
    }

    private function it_revokes_refresh_tokens_when_password_changes()
    {
        $this->updateUser(self::DANA_EMAIL, fn (UserDto $dto) => $dto->setPass('N3wPassw0rd'));

        $this->assertSame(0, $this->countRefreshTokens(self::DANA_EMAIL));
        $this->assertSame(1, $this->countRefreshTokens(self::BOB_EMAIL));
    }

    private function it_revokes_previous_email_refresh_tokens_when_email_changes()
    {
        $this->addRefreshToken('alice-second-refresh-token', self::ALICE_EMAIL);

        $this->updateUser(self::ALICE_EMAIL, fn (UserDto $dto) => $dto->setEmail('alice.new@democompany.com'));

        $this->assertSame(0, $this->countRefreshTokens(self::ALICE_EMAIL));
        $this->assertSame(1, $this->countRefreshTokens(self::BOB_EMAIL));
    }

    private function it_revokes_refresh_tokens_when_user_is_removed()
    {
        $this->addRefreshToken('dana-second-refresh-token', self::DANA_EMAIL);

        $this->entityTools->remove(
            $this->findUser(self::DANA_EMAIL)
        );

        $this->assertSame(0, $this->countRefreshTokens(self::DANA_EMAIL));
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

    private function addRefreshToken(string $refreshToken, string $username): void
    {
        $this->em->getConnection()->insert('refresh_tokens', [
            'refresh_token' => $refreshToken,
            'username' => $username,
            'valid' => '2099-01-01 00:00:00',
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
