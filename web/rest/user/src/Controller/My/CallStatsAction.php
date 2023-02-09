<?php

namespace Controller\My;

use ApiPlatform\Core\Exception\ResourceClassNotFoundException;
use Ivoz\Kam\Domain\Model\UsersCdr\UsersCdrRepository;
use Ivoz\Provider\Domain\Model\CallForwardSetting\CallForwardSettingRepository;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Model\CallStats as CallStatsModel;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class CallStatsAction
{
    public function __construct(
        private TokenStorageInterface $tokenStorage,
        private CallForwardSettingRepository $callForwardSettingRepository,
        private UsersCdrRepository $usersCdrRepository
    ) {
    }

    public function __invoke()
    {
        $token =  $this->tokenStorage->getToken();

        if (!$token || !$token->getUser()) {
            throw new ResourceClassNotFoundException('User not found');
        }

        /** @var UserInterface $user */
        $user = $token->getUser();
        $detours = $this
            ->callForwardSettingRepository
            ->countByUserId($user->getId());

        $totalCalls = $this
            ->usersCdrRepository
            ->countByUserId($user->getId());

        return new CallStatsModel(
            $totalCalls,
            $detours
        );
    }
}
