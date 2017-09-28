<?php

namespace Ivoz\Provider\Domain\Service\User;

use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Provider\Domain\Model\User\UserDTO;
use Ivoz\Provider\Domain\Model\User\UserInterface;

/**
 * Class UnsetBossAssistant
 * @todo move this into the entity
 * @package Ivoz\Provider\Domain\Service\User
 * @lifecycle pre_persist
 */
class UnsetBossAssistant implements UserLifecycleEventHandlerInterface
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

    public function execute(UserInterface $entity, $isNew)
    {
        $isBoss = $entity->getIsBoss() == 1;
        $hasChangedIsBoss = $entity->hasChanged('isBoss');

        if (!$isNew && $hasChangedIsBoss && $isBoss) {
            $boss = $entity->getBossAssistant();
            if($boss) {
                /**
                 * @var UserDTO $bossDTO
                 */
                $bossDTO = $boss->toDTO();
                $bossDTO->setBossAssistantId(null);

                $this->entityPersister->persistDto($bossDTO, $boss);
                /**
                 * @todo implement logger system
                 */
                $logMessage = "User unset as Boss Assistant of boss with id = '".$boss->getPrimaryKey()."'";
                // $this->_logger->log($logMessage, \Zend_Log::INFO);
            }
        }
    }
}