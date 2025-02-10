<?php

namespace Ivoz\Ast\Domain\Service\VoicemailMessage;

use Ivoz\Ast\Domain\Model\VoicemailMessage\VoicemailMessageInterface;
use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;

interface VoicemailMessageLifecycleEventHandlerInterface extends LifecycleEventHandlerInterface
{
    public function execute(VoicemailMessageInterface $voicemailMessage): void;
}
