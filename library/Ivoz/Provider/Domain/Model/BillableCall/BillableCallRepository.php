<?php

namespace Ivoz\Provider\Domain\Model\BillableCall;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface BillableCallRepository extends  ObjectRepository, Selectable
{

    /**
     * @param array $pks
     * @return bool
     */
    public function areRetarificable(array $pks);

    /**
     * @param array $ids
     * @return array
     */
    public function idsToCgrid(array $ids);

    /**
     * @param array $ids
     * @return array
     */
    public function idsToTrunkCdrId(array $ids);
}


