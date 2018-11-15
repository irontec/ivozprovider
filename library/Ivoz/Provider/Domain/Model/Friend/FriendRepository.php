<?php

namespace Ivoz\Provider\Domain\Model\Friend;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;
use Ivoz\Provider\Domain\Model\Domain\DomainInterface;

interface FriendRepository extends ObjectRepository, Selectable
{
    /**
     * @inheritdoc
     * @param DomainInterface $domain
     * @return FriendInterface | null
     */
    public function findOneByNameAndDomain(string $name, DomainInterface $domain);
}
