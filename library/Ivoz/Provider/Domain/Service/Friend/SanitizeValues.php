<?php

namespace Ivoz\Provider\Domain\Service\Friend;

use Ivoz\Provider\Domain\Model\Friend\FriendInterface;

/**
 * Class SanitizeValues
 * @package Ivoz\Provider\Domain\Service\Friend
 * @lifecycle pre_persist
 */
class SanitizeValues implements FriendLifecycleEventHandlerInterface
{
    public function __construct() {}

    public function execute(FriendInterface $entity, $isNew)
    {
        $entity->setDomain(
            $entity
                ->getCompany()
                ->getDomainUsers()
        );
    }
}
