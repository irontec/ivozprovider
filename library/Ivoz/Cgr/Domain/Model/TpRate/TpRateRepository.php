<?php

namespace Ivoz\Cgr\Domain\Model\TpRate;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface TpRateRepository extends ObjectRepository, Selectable
{
    /**
     * @param int $destinationRateGroupId
     * @return int affected rows
     */
    public function syncWithBusiness($destinationRateGroupId);
}
