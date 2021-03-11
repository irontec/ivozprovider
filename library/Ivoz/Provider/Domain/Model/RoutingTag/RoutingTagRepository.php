<?php

namespace Ivoz\Provider\Domain\Model\RoutingTag;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Persistence\ObjectRepository;

interface RoutingTagRepository extends ObjectRepository, Selectable
{
    /**
     * @param int $companyId
     * @return RoutingTagInterface[]
     * @see KlearCustomTarificatorController
     */
    public function findByCompanyId(int $companyId);
}
