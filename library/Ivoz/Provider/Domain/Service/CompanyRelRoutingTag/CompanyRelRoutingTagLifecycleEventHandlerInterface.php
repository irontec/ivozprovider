<?php

namespace Ivoz\Provider\Domain\Service\CompanyRelRoutingTag;

use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Provider\Domain\Model\CompanyRelRoutingTag\CompanyRelRoutingTagInterface;

interface CompanyRelRoutingTagLifecycleEventHandlerInterface extends LifecycleEventHandlerInterface
{
    public function execute(CompanyRelRoutingTagInterface $relRoutingTag);
}
