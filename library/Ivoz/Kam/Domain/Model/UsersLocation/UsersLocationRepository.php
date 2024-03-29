<?php

namespace Ivoz\Kam\Domain\Model\UsersLocation;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Persistence\ObjectRepository;

interface UsersLocationRepository extends ObjectRepository
{
    /**
     * @param string $domain
     * @param string $username
     * @return UsersLocationInterface
     */
    public function findOneByDomainUser(string $domain, string $username);

    /**
     * @return UsersLocationInterface[]
     * @throws \Doctrine\ORM\Query\QueryException
     */
    public function findByUsernameAndDomain(string $username, string $domain): array;

    /**
     * @param string[] $domains
     * @return UsersLocationInterface[]
     */
    public function findByDomains(array $domains): array;

    /**
     * @param string[] $names
     * @param string $domain
     * @return UsersLocationInterface[]
     */
    public function findByNamesInDomain(array $names, string $domain): array;
}
