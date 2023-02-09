<?php

namespace Ivoz\Provider\Domain\Service\Voicemail;

use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Provider\Domain\Model\Voicemail\VoicemailInterface;

interface VoicemailLifecycleEventHandlerInterface extends LifecycleEventHandlerInterface
{
    public function execute(VoicemailInterface $entity);
}
