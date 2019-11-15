<?php

namespace Ivoz\Provider\Domain\Model\Destination;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface DestinationRepository extends ObjectRepository, Selectable
{
    /**
     * @param array $destinations
     * @return int affected rows
     * @throws \Doctrine\DBAL\ConnectionException
     * @throws \Doctrine\DBAL\DBALException
     */
    public function insertIgnoreFromArray(array $destinations);
}
