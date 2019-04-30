<?php

namespace Ivoz\Provider\Domain\Model\Administrator;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface AdministratorRepository extends ObjectRepository, Selectable
{
    /**
     * @return AdministratorInterface
     * @throws \RuntimeException
     */
    public function getInnerGlobalAdmin();

    /**
     * @param string $username
     * @return null| AdministratorInterface
     */
    public function findPlatformAdminByUsername(string $username);
}
