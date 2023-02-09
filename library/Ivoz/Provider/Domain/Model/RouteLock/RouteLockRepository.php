<?php

namespace Ivoz\Provider\Domain\Model\RouteLock;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Persistence\ObjectRepository;

interface RouteLockRepository extends ObjectRepository, Selectable
{
    /**
     * @return array<RouteLockInterface>
     */
    public function findAllOrderByCompany(): array;
}
