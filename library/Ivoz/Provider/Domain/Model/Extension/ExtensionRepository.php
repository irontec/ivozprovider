<?php

namespace Ivoz\Provider\Domain\Model\Extension;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Persistence\ObjectRepository;

interface ExtensionRepository extends ObjectRepository, Selectable
{

    /**
     * @param int $id
     * @return ExtensionInterface[]
     */
    public function findByCompanyId($id);

    /**
     * @param int $companyId
     * @param int $extensionNumber
     * @return ExtensionInterface | null
     */
    public function findCompanyExtension(int $companyId, int $extensionNumber);
}
