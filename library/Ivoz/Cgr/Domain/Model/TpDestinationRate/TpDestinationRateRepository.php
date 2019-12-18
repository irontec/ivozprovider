<?php

namespace Ivoz\Cgr\Domain\Model\TpDestinationRate;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Common\Persistence\ObjectRepository;

interface TpDestinationRateRepository extends ObjectRepository, Selectable
{
    /**
     * @param int $destinationRateGroupId
     * @return int affected rows
     */
    public function syncWithBussines($destinationRateGroupId);
}
