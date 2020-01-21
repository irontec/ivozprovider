<?php

namespace Ivoz\Provider\Domain\Model\Domain;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Common\Persistence\ObjectRepository;

interface DomainRepository extends ObjectRepository, Selectable
{

    /**
     * @param string $endpointDomain
     * @return DomainInterface | null
     */
    public function findOneByDomain($endpointDomain);
}
