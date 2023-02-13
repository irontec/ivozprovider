<?php

namespace Ivoz\Ast\Domain\Service\VoicemailMessage;

use Ivoz\Core\Domain\Service\EntityTools;
use Ivoz\Provider\Domain\Model\VoicemailMessage\VoicemailMessageInterface as IvozVoicemailMessageInterface;
use Ivoz\Provider\Domain\Service\VoicemailMessage\VoicemailMessageLifecycleEventHandlerInterface as IvozVoicemailMessageLifecycleEventHandlerInterface;

class DeletedByIvozVoicemailMessage implements IvozVoicemailMessageLifecycleEventHandlerInterface
{
    public const POST_REMOVE_PRIORITY = self::PRIORITY_NORMAL;

    public function __construct(
        private EntityTools $entityTools,
    ) {
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_POST_REMOVE => self::POST_REMOVE_PRIORITY
        ];
    }

    /**
     * @return void
     */
    public function execute(IvozVoicemailMessageInterface $ivozVoicemailMessage)
    {
        $voicemailMessage = $ivozVoicemailMessage->getAstVoicemailMessage();
        if (!$voicemailMessage) {
            return;
        }

        $this->entityTools->remove(
            $voicemailMessage,
        );
    }
}
