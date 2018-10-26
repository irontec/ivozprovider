<?php

namespace Ivoz\Provider\Domain\Model\Domain;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface DomainRepository extends ObjectRepository, Selectable
{

    /**
     * @param $endpointDomain
     * @return DomainInterface | null
     */
    public function findOneByDomain($endpointDomain);
}
