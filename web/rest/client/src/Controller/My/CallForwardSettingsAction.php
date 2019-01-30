<?php

namespace Controller\My;

use ApiPlatform\Core\Exception\ResourceClassNotFoundException;
use Ivoz\Provider\Domain\Model\CallForwardSetting\CallForwardSettingRepository;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class CallForwardSettingsAction
{
    /**
     * @var TokenStorage
     */
    protected $tokenStorage;

    /**
     * @var CallForwardSettingRepository
     */
    protected $callForwardSettingRepository;

    public function __construct(
        TokenStorage $tokenStorage,
        CallForwardSettingRepository $callForwardSettingRepository
    ) {
        $this->tokenStorage = $tokenStorage;
        $this->callForwardSettingRepository = $callForwardSettingRepository;
    }

    public function __invoke()
    {
        /** @var TokenInterface $token */
        $token =  $this->tokenStorage->getToken();

        if (!$token || !$token->getUser()) {
            throw new ResourceClassNotFoundException('User not found');
        }

        $response = $this
            ->callForwardSettingRepository
            ->findAndJoinByUser($token->getUser());

        return $response;
    }
}
