<?php

namespace Ivoz\Provider\Domain\Service\Fax;

use Ivoz\Provider\Domain\Model\Fax\FaxInterface;

/**
 * Class SanitizeValues
 * @package Ivoz\Provider\Domain\Service\Fax
 * @lifecycle pre_persist
 */
class SanitizeValues implements FaxLifecycleEventHandlerInterface
{
    public function __construct() {}

    public function execute(FaxInterface $entity, $isNew)
    {
        // @todo move this to the entity
        if ($entity->getSendByEmail() == 0) {
            $entity->setEmail(null);
        }
    }
}
