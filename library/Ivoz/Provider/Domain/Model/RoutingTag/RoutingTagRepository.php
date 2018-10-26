<?php

namespace Ivoz\Provider\Domain\Model\RoutingTag;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface RoutingTagRepository extends ObjectRepository, Selectable
{
    /**
     * @param int $companyId
     * @return RoutingTagInterface[]
     * @deprecated dead code
     */
    public function findByCompanyId(int $companyId);
}
