<?php

namespace Ivoz\Provider\Domain\Model\CarrierServer;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Persistence\ObjectRepository;

interface CarrierServerRepository extends ObjectRepository, Selectable
{
    /**
     * @return CarrierServer[]
     */
    public function findByCarrierId(int $carrierId): array;
}
