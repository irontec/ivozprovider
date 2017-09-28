<?php

namespace Ivoz\Kam\Domain\Service\TrunksDialplan;

use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Kam\Domain\Model\TrunksDialplan\TrunksDialplanInterface;

/**
 * Class SanitizeValues
 * @package Ivoz\Kam\Domain\Service\TrunksDialplan
 * @lifecycle pre_persist
 */
class SanitizeValues implements TrunksDialplanLifecycleEventHandlerInterface
{
    public function __construct() {}

    public function execute(TrunksDialplanInterface $entity)
    {
        /**
         * @todo this logic depends on klear screen and must be redesigned
         */
        throw new \Exception('Mot implemented yet');
    }
}