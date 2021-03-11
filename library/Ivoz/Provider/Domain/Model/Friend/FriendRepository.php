<?php

namespace Ivoz\Provider\Domain\Model\Friend;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Persistence\ObjectRepository;
use Ivoz\Provider\Domain\Model\Domain\DomainInterface;

interface FriendRepository extends ObjectRepository, Selectable
{
    /**
     * @inheritdoc
     * @param DomainInterface $domain
     * @return FriendInterface | null
     */
    public function findOneByNameAndDomain(string $name, DomainInterface $domain);

    /**
     * @param int $companyId
     * @return string[]
     */
    public function findNamesByCompanyId(int $companyId);

    /**
     * @param int[] $companyIds
     * @return int
     */
    public function countRegistrableDevices(array $companyIds): int;
}
