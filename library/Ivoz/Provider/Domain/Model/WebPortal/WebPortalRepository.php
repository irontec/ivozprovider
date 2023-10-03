<?php

namespace Ivoz\Provider\Domain\Model\WebPortal;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Persistence\ObjectRepository;

/**
 * @template-extends ObjectRepository<WebPortalInterface>
 * @template-extends Selectable<WebPortalInterface>
 */
interface WebPortalRepository extends ObjectRepository, Selectable
{
    public function findByServerName(string $serverName): ?WebPortalInterface;

    public function findByServerNameAndType(string $serverName, string $type): ?WebPortalInterface;
}
