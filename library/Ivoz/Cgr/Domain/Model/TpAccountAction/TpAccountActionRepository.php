<?php

namespace Ivoz\Cgr\Domain\Model\TpAccountAction;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Persistence\ObjectRepository;

interface TpAccountActionRepository extends ObjectRepository, Selectable
{
    /**
     * @param int $companyId
     */
    public function findByCompany(int $companyId);
    /**
     * @param int $carrierId
     */
    public function findByCarrier(int $carrierId);
}
