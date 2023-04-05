<?php

use Symfony\Component\HttpFoundation\JsonResponse;
use Ivoz\Core\Domain\Service\DomainEventPublisher;
use Ivoz\Core\Domain\RequestId;
use Ivoz\Core\Domain\Event\CommandWasExecuted;
use Service\Encoder;

class EncoderController
{
    public function __construct(
        private Encoder $encoder,
        private DomainEventPublisher $domainEventPublisher,
        private RequestId $requestId
    ) {
    }

    public function index(): JsonResponse
    {
        $this->registerCommand();

        $this
            ->encoder
            ->processAction();

        return new JsonResponse([
            'status' => 'Done!'
        ]);
    }

    private function registerCommand(): void
    {
        $event = new CommandWasExecuted(
            $this->requestId->toString(),
            'Recordings',
            'processRtpRecording',
            [],
            []
        );

        $this
            ->domainEventPublisher
            ->publish($event);
    }
}
