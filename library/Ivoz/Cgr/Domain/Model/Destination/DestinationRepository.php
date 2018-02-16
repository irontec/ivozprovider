<?php

namespace Ivoz\Cgr\Domain\Model\Destination;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface DestinationRepository extends ObjectRepository, Selectable
{
    /**
     * @param string $tag
     * @return int
     */
    public function findOneByTag(string $tag);
}

