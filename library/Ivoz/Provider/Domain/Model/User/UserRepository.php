<?php

namespace Ivoz\Provider\Domain\Model\User;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface UserRepository extends ObjectRepository, Selectable
{
    public function getAssignedTerminalIds();
}

