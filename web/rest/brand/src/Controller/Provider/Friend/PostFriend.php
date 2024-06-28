<?php

namespace Controller\Provider\Friend;

use ApiPlatform\Core\Exception\ResourceClassNotFoundException;
use Ivoz\Provider\Domain\Model\Administrator\AdministratorInterface;
use Ivoz\Provider\Domain\Model\Friend\Friend;
use Ivoz\Provider\Application\Service\Friend\CreateInterVpbxFriend;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class PostFriend
{
    public function __construct(
        private CreateInterVpbxFriend $createInterVpbx,
        private DenormalizerInterface $denormalizer,
        private TokenStorageInterface $tokenStorage
    ) {
    }

    public function __invoke(Request $request): Friend
    {
        $token = $this->tokenStorage->getToken();

        if (!$token || !$token->getUser()) {
            throw new ResourceClassNotFoundException('User not found');
        }

        /** @var AdministratorInterface $user */
        $user = $token->getUser();

        $brand = $user->getBrand();
        if (!$brand) {
            throw new ResourceClassNotFoundException('User brand not found');
        }

        /** @phpstan-ignore-next-line */
        $data = $this->denormalizer->decode(
            $request->getContent(),
            $request->getRequestFormat(),
            []
        );

        if (isset($data['directConnectivity']) && $data['directConnectivity'] === Friend::DIRECTCONNECTIVITY_INTERVPBX) {
                $data['name'] = 'noNameRequired';
        }

        /** @var Friend $friend */
        $friend = $this->denormalizer->denormalize(
            $data,
            Friend::class,
            $request->getRequestFormat()
        );

        if ($friend->getDirectConnectivity() === Friend::DIRECTCONNECTIVITY_INTERVPBX) {
            $this->createInterVpbx->execute($friend);
        }

        return $friend;
    }
}
