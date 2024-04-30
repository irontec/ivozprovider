<?php

namespace Controller\My;

use ApiPlatform\Core\Exception\ResourceClassNotFoundException;
use Ivoz\Provider\Domain\Model\Voicemail\VoicemailInterface;
use Ivoz\Provider\Domain\Model\Voicemail\VoicemailRepository;
use Ivoz\Provider\Domain\Model\VoicemailRelUser\VoicemailRelUser;
use Ivoz\Provider\Domain\Model\VoicemailRelUser\VoicemailRelUserInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Ivoz\Provider\Domain\Model\User\UserInterface;

class VoicemailsAction
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

        $relVoicemails = array_map(
            function (VoicemailRelUserInterface $voicemailRelUser): VoicemailInterface {
                return $voicemailRelUser->getVoicemail();
            },
            $user->getVoicemailRelUsers()
        );

        $ownVoicemail = $this
            ->voicemailRepository
            ->getVoicemailsByUser($user);

        return array_merge(
            $ownVoicemail,
            $relVoicemails
        );
    }
}
