<?php

namespace Ivoz\Kam\Domain\Model\UsersLocation;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface UsersLocationRepository extends ObjectRepository
{
    /**
     * @param string $domain
     * @param string $username
     * @return UsersLocationInterface
     */
    public function findOneByDomainUser(string $domain, string $username);
}
