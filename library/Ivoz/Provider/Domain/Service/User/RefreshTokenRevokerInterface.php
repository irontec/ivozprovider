<?php

namespace Ivoz\Provider\Domain\Service\User;

interface RefreshTokenRevokerInterface
{
    public function revokeByUsername(string $username): void;
}
