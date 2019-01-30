<?php

namespace Controller\My;

use ApiPlatform\Core\Exception\ResourceClassNotFoundException;
use Ivoz\Kam\Domain\Model\UsersCdr\UsersCdrRepository;
use Ivoz\Provider\Domain\Model\CallForwardSetting\CallForwardSettingRepository;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Model\CallStats as CallStatsModel;

class CallStatsAction
{
    /**
     * @var TokenStorage
     */
    protected $tokenStorage;

    /**
     * @var CallForwardSettingRepository
     */
    protected $callForwardSettingRepository;

    /**
     * @var UsersCdrRepository
     */
    protected $usersCdrRepository;

    public function __construct(
        TokenStorage $tokenStorage,
        CallForwardSettingRepository $callForwardSettingRepository,
        UsersCdrRepository $usersCdrRepository
    ) {
        $this->tokenStorage = $tokenStorage;
        $this->callForwardSettingRepository = $callForwardSettingRepository;
        $this->usersCdrRepository = $usersCdrRepository;
    }

    public function __invoke()
    {
        /** @var TokenInterface $token */
        $token =  $this->tokenStorage->getToken();

        if (!$token || !$token->getUser()) {
            throw new ResourceClassNotFoundException('User not found');
        }

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
