<?php

namespace Ivoz\Provider\Infrastructure\Persistence\Dbal;

use Doctrine\DBAL\Connection;
use Ivoz\Provider\Domain\Service\User\RefreshTokenRevokerInterface;

class RefreshTokenDbalRevoker implements RefreshTokenRevokerInterface
{
    public function __construct(
        private Connection $connection
    ) {
    }

    public function revokeByUsername(string $username): void
    {
        $this->connection->executeStatement(
            'DELETE FROM refresh_tokens WHERE username = ?',
            [$username]
        );
    }
}
