<?php

namespace Ivoz\Provider\Domain\Service\RetailAccount;

use Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountInterface;

/**
 * Class SanitizeValues
 * @package Ivoz\Provider\Domain\Service\RetailAccount
 * @lifecycle pre_persist
 */
class SanitizeValues implements RetailAccountLifecycleEventHandlerInterface
{
    public function __construct() {}

    public function execute(RetailAccountInterface $entity, $isNew)
    {
        /**
         * @todo rewrite this
         */
        // Set account domain to its brand domain
        $entity->setDomain(
            $entity
                ->getCompany()
                ->getBrand()
                ->getDomain()
        );
    }
}