<?php

namespace Controller\My;

use ApiPlatform\Core\Bridge\Doctrine\Orm\Paginator;
use ApiPlatform\Core\Exception\ResourceClassNotFoundException;
use Ivoz\Api\Doctrine\Orm\Extension\CollectionExtensionList;
use Ivoz\Provider\Domain\Model\CallForwardSetting\CallForwardSetting;
use Ivoz\Provider\Domain\Model\CallForwardSetting\CallForwardSettingInterface;
use Ivoz\Provider\Domain\Model\CallForwardSetting\CallForwardSettingRepository;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class CallForwardSettingsAction
{
    use FilterCollectionTrait;

    public function __construct(
        private TokenStorageInterface $tokenStorage,
        private CallForwardSettingRepository $callForwardSettingRepository,
        CollectionExtensionList $collectionExtensions,
        RequestStack $requestStack
    ) {
        $this->collectionExtensions = $collectionExtensions;
        $this->request = $requestStack->getCurrentRequest();
    }

    public function __invoke()
    {
        $token =  $this->tokenStorage->getToken();

        if (!$token || !$token->getUser()) {
            throw new ResourceClassNotFoundException('User not found');
        }

        /** @var UserInterface $user */
        $user = $token->getUser();

        $qb = $this
            ->callForwardSettingRepository
            ->prepareAndJoinByUser(
                $user
            );

        $response = $this->applyCollectionExtensions(
            $qb,
            CallForwardSetting::class,
            'get_my_call_forward_settings'
        );

        $cfs = $response instanceof Paginator
            ? $response->getIterator()
            : new \ArrayIterator([...$response]);

        return $cfs;
    }
}
