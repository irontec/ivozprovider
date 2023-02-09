<?php

namespace Controller\My;

use ApiPlatform\Core\Exception\ResourceClassNotFoundException;
use Ivoz\Provider\Domain\Model\Voicemail\VoicemailRepository;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Ivoz\Provider\Domain\Model\User\UserInterface;

class CompanyVoicemailsAction
{
    public function __construct(
        private TokenStorageInterface $tokenStorage,
        private VoicemailRepository $voicemailRepository
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

        return $this
            ->voicemailRepository
            ->getAvailableVoicemailsForUser($user);
    }
}
