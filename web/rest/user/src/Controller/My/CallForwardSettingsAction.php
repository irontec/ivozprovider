<?php

namespace Controller\My;

use ApiPlatform\Core\Exception\ResourceClassNotFoundException;
use Ivoz\Provider\Domain\Model\CallForwardSetting\CallForwardSettingRepository;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Ivoz\Provider\Domain\Model\User\UserInterface;

class CallForwardSettingsAction
{
    public function __construct(
        private TokenStorageInterface $tokenStorage,
        private CallForwardSettingRepository $callForwardSettingRepository
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

        $response = $this
            ->callForwardSettingRepository
            ->findAndJoinByUser($user);

        return $response;
    }
}
