<?php

namespace Ivoz\Kam\Domain\Service\TrunksUacreg;

use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Kam\Domain\Model\TrunksUacreg\TrunksUacregInterface;

/**
 * Class SanitizeValues
 * @package Ivoz\Kam\Domain\Service\TrunksUacreg
 * @lifecycle pre_persist
 */
class SanitizeValues implements TrunksUacregLifecycleEventHandlerInterface
{
    public function __construct() {}

    public function execute(TrunksUacregInterface $entity, $isNew)
    {
        if (empty($entity->getAuthUsername())) {
            $entity->setAuthUsername($entity->getRUsername());
        }

        if (empty($entity->getAuthProxy())) {
            $entity->setAuthProxy('sip:' . $entity->getRDomain());
        }

        // Multi-Ddi support
        if (!$entity->getMultiDdi()) {
            return;
        }

        $multiDdi_is_enabled_in_new_item = $isNew; # New item
        $multiDdi_has_been_enabled = !$isNew && $entity->hasChanged('multiDdi'); # Existing item
        if ($multiDdi_has_been_enabled || $multiDdi_is_enabled_in_new_item) {
            $entity->setLUuid(round(microtime(true) * 1000));
        }
    }
}