<?php

namespace Ivoz\Kam\Domain\Model\AccCdr;

use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface AccCdrRepository extends ObjectRepository, Selectable
{
    /**
     * @param array $criteria
     * @param array|null $orderBy
     * @param null $limit
     * @param null $offset
     * @return Collection
     */
    public function fetchTarificableList(array $criteria, array $orderBy = null, $limit = null, $offset = null);

    public function countTarificableByQuery(array $criteria);
}

