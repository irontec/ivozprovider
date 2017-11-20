<?php

namespace Ivoz\Provider\Domain\Service\Locution;

use Ivoz\Provider\Domain\Model\Locution\LocutionInterface;

/**
 * Class SanitizeValues
 * @package Ivoz\Provider\Domain\Service\Locution
 * @lifecycle pre_persist
 */
class SanitizeValues implements LocutionLifecycleEventHandlerInterface
{
    public function __construct() {}

    public function execute(LocutionInterface $entity)
    {
        if ($entity->getTempFileByFieldName('OriginalFile')) {
            $entity->setStatus('pending');
        }
    }
}