<?php

namespace Ivoz\Provider\Domain\Service\VoicemailMessage;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Ast\Domain\Model\VoicemailMessage\VoicemailMessageRepository as AstVoicemailMessageRepository;
use Ivoz\Core\Domain\Model\Commandlog\Commandlog;
use Psr\Log\LoggerInterface;

class MigrateFromUnparsedAstVoicemailMessages
{
    public const BATCH_SIZE = 100;

    public function __construct(
        private AstVoicemailMessageRepository $astVoicemailMessageRepository,
        private EntityTools $entityTools,
        private MigrateFromAstVoicemailMessage $migrateFromAstVoicemailMessage,
        private LoggerInterface $logger
    ) {
    }

    /**
     * @return void
     */
    public function execute()
    {
        $astVoicemailMessageGenerator = $this->astVoicemailMessageRepository->getUnparsedMessagesGeneratorWithoutOffset(
            self::BATCH_SIZE
        );

        $msgCount = 0;
        foreach ($astVoicemailMessageGenerator as $astVoicemailMessages) {
            if (empty($astVoicemailMessages)) {
                break;
            }

            foreach ($astVoicemailMessages as $astVoicemailMessage) {
                $this->migrateFromAstVoicemailMessage->execute(
                    $astVoicemailMessage,
                );
            }

            try {
                $this->entityTools->dispatchQueuedOperations();
                $this->entityTools->clearExcept(
                    Commandlog::class
                );

                $msgCount += count($astVoicemailMessages);
            } catch (\Exception $e) {
                $this->logger->error('Voicemail Message migration service error:: ' . $e->getMessage());
                // Keep going
            }
        }

        $this->logger->info('Voicemail Messages migration service has migrated ' . $msgCount . ' entries successfully');
    }
}
