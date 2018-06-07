<?php

namespace Ivoz\Ast\Domain\Service\PsEndpoint;

use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Ivoz\Provider\Domain\Service\User\UserLifecycleEventHandlerInterface;

/**
 * Class UpdateByUser
 * @package Ivoz\Ast\Domain\Service\PsEndpoint
 * @lifecycle pre_persist
 */
class UpdateByUser implements UserLifecycleEventHandlerInterface
{
    /**
     * @var EntityPersisterInterface
     */
    protected $entityPersister;

    public function __construct(
        EntityPersisterInterface $entityPersister
    ) {
        $this->entityPersister = $entityPersister;
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_POST_PERSIST => 40,
            self::EVENT_PRE_REMOVE => 10
        ];
    }

    public function execute(UserInterface $entity, $isNew)
    {
        $endpoint = $entity->getEndpoint();
        if (!$endpoint) {
            return;
        }

        $callerId = sprintf(
            '%s <%s>',
            $entity->getFullName(),
            $entity->getExtensionNumber()
        );

        $endpoint
            ->setCallerid($callerId)
            ->setMailboxes($entity->getVoiceMail());

        $this
            ->entityPersister
            ->persist($endpoint);
    }
}