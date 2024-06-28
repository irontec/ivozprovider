<?php

namespace Ivoz\Provider\Domain\Service\VoicemailRelUser;

use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Provider\Domain\Model\VoicemailRelUser\VoicemailRelUser;

interface VoicemailRelUserLifecycleEventHandlerInterface extends LifecycleEventHandlerInterface
{
    public function execute(VoicemailRelUser $voicemailRelUser): void;
}
