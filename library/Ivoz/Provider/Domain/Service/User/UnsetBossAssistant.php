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
    /**
     * @var EntityTools
     */
    protected $entityTools;

    /**
     * @var UserRepository
     */
    protected $userRepository;

    public function __construct(
        EntityTools $entityTools,
        UserRepository $userRepository
    ) {
        $this->entityTools = $entityTools;
        $this->userRepository = $userRepository;
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_POST_PERSIST => 30
        ];
    }

    public function execute(UserInterface $user)
    {
        $isNew = $user->isNew();
        $isBoss = $user->getIsBoss() == 1;
        $hasChangedIsBoss = $user->hasChanged('isBoss');

        if (!$isNew && $hasChangedIsBoss && $isBoss) {

            /** @var UserInterface[] $bosses */
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
