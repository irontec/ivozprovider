<?php

namespace Ivoz\Provider\Domain\Model\Extension;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface ExtensionRepository extends ObjectRepository, Selectable
{

    /**
     * @param $id
     * @return ExtensionInterface | null
     */
    public function findByCompanyId($id);
}
