<?php

namespace Ivoz\Cgr\Domain\Model\TpRate;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Persistence\ObjectRepository;

interface TpRateRepository extends ObjectRepository, Selectable
{
    /**
     * @param int $destinationRateGroupId
     * @return int affected rows
     */
    public function syncWithBusiness($destinationRateGroupId);
}
