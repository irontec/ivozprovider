<?php

namespace Ivoz\Provider\Domain\Service\VoicemailMessage;

use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Provider\Domain\Model\VoicemailMessage\VoicemailMessageInterface;

interface VoicemailMessageLifecycleEventHandlerInterface extends LifecycleEventHandlerInterface
{
    public function execute(VoicemailMessageInterface $voicemailMessage);
}
