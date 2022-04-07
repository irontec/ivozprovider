<?php

use Symfony\Component\HttpFoundation\Response;
use Ivoz\Provider\Domain\Service\VoicemailMessage\MigrateFromUnparsedAstVoicemailMessages as VoicemailMessageFromAstVoicemailMessage;
use Ivoz\Core\Domain\Service\DomainEventPublisher;
use Ivoz\Core\Application\RequestId;
use Ivoz\Core\Application\RegisterCommandTrait;
use Psr\Log\LoggerInterface;

class VoicemailMessageController
{
    use RegisterCommandTrait;

    public function __construct(
        private VoicemailMessageFromAstVoicemailMessage $voicemailMessageFromAstVoicemailMessage,
        private LoggerInterface $logger,
        DomainEventPublisher $eventPublisher,
        RequestId $requestId
    ) {
        $this->eventPublisher = $eventPublisher;
        $this->requestId = $requestId;
    }

    public function indexAction(): Response
    {
        try {
            $this->registerCommand('Scheduler', 'voicemailMessage');
            $this->voicemailMessageFromAstVoicemailMessage->execute();
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
            return new Response(
                $e->getMessage() . "\n",
                500
            );
        }

        return new Response("Voicemail Messages migration done!\n", 200);
    }
}
