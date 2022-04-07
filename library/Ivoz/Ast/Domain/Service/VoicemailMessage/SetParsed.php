<?php

namespace Ivoz\Ast\Domain\Service\VoicemailMessage;

use Ivoz\Ast\Domain\Model\VoicemailMessage\VoicemailMessageDto;
use Ivoz\Ast\Domain\Model\VoicemailMessage\VoicemailMessageInterface;
use Ivoz\Core\Application\Service\EntityTools;

class SetParsed
{
    public function __construct(
        private EntityTools $entityTools
    ) {
    }

    public function execute(
        VoicemailMessageInterface $voicemailMessage,
    ): void {
        /** @var VoicemailMessageDto $voicemailMessageDto */
        $voicemailMessageDto = $this->entityTools->entityToDto(
            $voicemailMessage
        );
        $voicemailMessageDto->setParsed(true);
        $this->entityTools->persistDto(
            $voicemailMessageDto,
            $voicemailMessage
        );
    }
}
