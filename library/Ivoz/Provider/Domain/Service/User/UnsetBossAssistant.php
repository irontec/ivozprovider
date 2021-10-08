<?php

namespace Ivoz\Provider\Domain\Service\User;

use Ivoz\Core\Application\Service\EntityTools;
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
    public function __construct(
        private EntityTools $entityTools,
        private UserRepository $userRepository
    ) {
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_POST_PERSIST => 30
        ];
    }

    /**
     * @return void
     */
    public function execute(UserInterface $user)
    {
        $isNew = $user->isNew();
        $isBoss = $user->getIsBoss() == 1;
        $hasChangedIsBoss = $user->hasChanged('isBoss');

        if (!$isNew && $hasChangedIsBoss && $isBoss) {
            $bosses = $this
                ->userRepository
                ->findByBossAssistantId($user->getId());

            foreach ($bosses as $boss) {
                /**
                 * @var UserDto $bossDto
                 */
                $bossDto = $this->entityTools->entityToDto($boss);
                $bossDto->setBossAssistantId(null);

                $this->entityTools->persistDto(
                    $bossDto,
                    $boss
                );
            }
        }
    }
}
