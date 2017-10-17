<?php

namespace Ivoz\Kam\Domain\Model\AccCdr;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface AccCdrRepository extends ObjectRepository, Selectable
{
    /**
     * @param int $companyId
     * @param int $brandId
     * @param string $startTimeUtc
     * @param int $metered
     * @return int
     */
    public function fetchUntarificattedCallNumber(
        int $companyId,
        int $brandId,
        string $startTimeUtc,
        int $metered
    );

    /**
     * @param int $companyId
     * @param int $brandId
     * @param string $startTimeUtc
     * @param string $utcNextInvoiceInDate
     * @return mixed
     */
    public function fetchTarificableList(
        int $companyId,
        int $brandId,
        string $startTimeUtc,
        string $utcNextInvoiceInDate
    );

    /**
     * @param array $criteria
     * @return mixed
     */
    public function countTarificableByQuery(array $criteria);
}

