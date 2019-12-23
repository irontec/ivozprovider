<?php

namespace Ivoz\Provider\Domain\Model\Administrator;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Common\Persistence\ObjectRepository;

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
