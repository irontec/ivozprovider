<?php

namespace Tests;

use Ivoz\Provider\Domain\Model\User\UserRepository;

trait UserAccessControlTestHelperTrait
{
    protected function getRepository()
    {
        return $this
            ->serviceContainer
            ->get(UserRepository::class);
    }
}
