<?php

namespace Ivoz\Provider\Domain\Model\WebPortal;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface WebPortalRepository extends ObjectRepository, Selectable
{
    /**
     * @param string $serverName
     * @return WebPortalInterface | null
     */
    public function findUserUrlByServerName(string $serverName);
}
