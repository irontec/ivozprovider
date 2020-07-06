<?php

namespace Ivoz\Provider\Domain\Model\WebPortal;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Common\Persistence\ObjectRepository;

interface WebPortalRepository extends ObjectRepository, Selectable
{
    /**
     * @param string $serverName
     * @return WebPortalInterface | null
     */
    public function findUserUrlByServerName(string $serverName);
}
