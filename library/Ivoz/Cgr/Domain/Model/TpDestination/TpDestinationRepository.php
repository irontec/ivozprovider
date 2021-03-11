<?php

namespace Ivoz\Cgr\Domain\Model\TpDestination;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Persistence\ObjectRepository;

interface TpDestinationRepository extends ObjectRepository, Selectable
{
    /**
     * @return int affected rows
     */
    public function syncWithBusiness();

    /**
     * @param string $destinationTag
     * @return null| TpDestinationInterface
     */
    public function findOneByTag($destinationTag);
}
