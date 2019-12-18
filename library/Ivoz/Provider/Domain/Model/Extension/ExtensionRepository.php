<?php

namespace Ivoz\Provider\Domain\Model\Extension;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Common\Persistence\ObjectRepository;

interface ExtensionRepository extends ObjectRepository, Selectable
{

    /**
     * @param int $id
     * @return ExtensionInterface | null
     */
    public function findByCompanyId($id);
}
