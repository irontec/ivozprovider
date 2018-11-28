<?php

namespace Ivoz\Cgr\Domain\Model\TpDestination;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface TpDestinationRepository extends ObjectRepository, Selectable
{
    /**
     * @param $destinationTag
     * @return null| TpDestinationInterface
     */
    public function findOneByTag($destinationTag);
}
