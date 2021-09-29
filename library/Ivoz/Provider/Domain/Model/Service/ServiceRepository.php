<?php

namespace Ivoz\Provider\Domain\Model\Service;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Persistence\ObjectRepository;

interface ServiceRepository extends ObjectRepository, Selectable
{
    /**
     * @return ServiceInterface[]
     */
    public function getServicesInGroup(array $ids);
}
