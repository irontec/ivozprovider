<?php

namespace Controller\My;

use ApiPlatform\Core\Bridge\Doctrine\Orm\Paginator;
use ApiPlatform\Core\Exception\ResourceClassNotFoundException;
use Ivoz\Api\Doctrine\Orm\Extension\CollectionExtensionList;
use Ivoz\Provider\Domain\Model\Voicemail\Voicemail;
use Ivoz\Provider\Domain\Model\Voicemail\VoicemailRepository;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Ivoz\Provider\Domain\Model\User\UserInterface;

class VoicemailsAction
{
    use FilterCollectionTrait;

    public function __construct(
        private TokenStorageInterface $tokenStorage,
        private VoicemailRepository $voicemailRepository,
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
            ->voicemailRepository
            ->prepareAndJoinByUser($user);

        $response = $this->applyCollectionExtensions(
            $qb,
            Voicemail::class,
            'get_my_voicemails'
        );

        return $response instanceof Paginator
            ? $response->getIterator()
            : new \ArrayIterator([...$response]);
    }
}
