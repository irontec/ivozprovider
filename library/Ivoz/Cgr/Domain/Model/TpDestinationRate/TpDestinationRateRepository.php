<?php

namespace Ivoz\Cgr\Domain\Model\TpDestinationRate;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface TpDestinationRateRepository extends ObjectRepository, Selectable
{
    /**
     * @param int $destinationRateGroupId
     * @return int affected rows
     */
    public function syncWithBussines($destinationRateGroupId);
}
