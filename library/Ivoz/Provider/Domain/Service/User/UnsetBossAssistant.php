<?php

namespace Ivoz\Provider\Domain\Service\User;

use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Provider\Domain\Model\User\UserDto;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Ivoz\Provider\Domain\Model\User\UserRepository;

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

    /**
     * @var UserRepository
     */
    protected $userRepository;

    public function __construct(
        EntityPersisterInterface $entityPersister,
        UserRepository $userRepository
    ) {
        $this->entityPersister = $entityPersister;
        $this->userRepository = $userRepository;
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_POST_PERSIST => 30
        ];
    }

    public function execute(UserInterface $entity, $isNew)
    {
        $isBoss = $entity->getIsBoss() == 1;
        $hasChangedIsBoss = $entity->hasChanged('isBoss');

        if (!$isNew && $hasChangedIsBoss && $isBoss) {

            $bosses = $this
                ->userRepository
                ->findBy(['bossAssistant' => $entity->getId()]);

            foreach ($bosses as $boss) {
                /**
                 * @var UserDTO $bossDto
                 */
                $bossDto = $boss->toDto();
                $bossDto->setBossAssistantId(null);

                $this->entityPersister->persistDto($bossDto, $boss);
            }
        }
    }
}