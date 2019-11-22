<?php

namespace Ivoz\Provider\Domain\Model\DestinationRate;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface DestinationRateRepository extends ObjectRepository, Selectable
{
    /**
     * @param array $destinationRates
     * @return int affected rows
     * @throws \Doctrine\DBAL\ConnectionException
     * @throws \Doctrine\DBAL\DBALException
     */
    public function insertIgnoreFromArray(array $destinationRates);
}
