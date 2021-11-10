<?php

namespace Ivoz\Provider\Infrastructure\Api\Security\User;

use Symfony\Component\Security\Core\User\UserProviderInterface;

interface MutableUserProviderInterface extends UserProviderInterface
{
    public function setEntityClass(string $class): self;
}
