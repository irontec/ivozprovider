<?php

namespace Ivoz\Provider\Domain\Service\Friend;

use Ivoz\Core\Domain\Assert\Assertion;
use Ivoz\Core\Domain\Service\AvoidEntityUpdatesAbstract;
use Ivoz\Provider\Domain\Model\Friend\FriendDto;
use Ivoz\Provider\Domain\Model\Friend\FriendInterface;
use Ivoz\Provider\Domain\Service\Friend\FriendLifecycleEventHandlerInterface;

class AvoidUpdateCompany implements FriendLifecycleEventHandlerInterface
{
    public const PRE_PERSIST_PRIORITY = self::PRIORITY_NORMAL;

    /**
     * @return array<string,int>
     */
    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_PRE_PERSIST => self::PRE_PERSIST_PRIORITY,
        ];
    }

    public function execute(FriendInterface $friend): void
    {
        if ($friend->isNew()) {
            return;
        }

        Assertion::false(
            $friend->hasChanged('companyId')
        );
    }
}
