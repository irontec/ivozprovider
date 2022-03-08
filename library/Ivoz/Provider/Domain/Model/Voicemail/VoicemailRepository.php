<?php

namespace Ivoz\Provider\Domain\Model\Voicemail;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Persistence\ObjectRepository;
use Ivoz\Provider\Domain\Model\User\UserInterface;

interface VoicemailRepository extends ObjectRepository, Selectable
{
    /**
     * @param UserInterface $user
     * @return VoicemailInterface[]
     */
    public function getAvailableVoicemailsForUser(UserInterface $user): array;
}
