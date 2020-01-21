<?php

namespace Ivoz\Provider\Domain\Model\Destination;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Common\Persistence\ObjectRepository;

interface DestinationRepository extends ObjectRepository, Selectable
{
    /**
     * @param array $destinations
     * @return int affected rows
     * @throws \Doctrine\DBAL\ConnectionException
     * @throws \Doctrine\DBAL\DBALException
     */
    public function insertIgnoreFromArray(array $destinations);

    /**
     * Returns ['prefix' => id] array
     *
     * @param int $brandId
     * @return array
     */
    public function getPrefixArrayByBrandId(int $brandId): array;
}
