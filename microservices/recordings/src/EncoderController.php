<?php

use Symfony\Component\HttpFoundation\JsonResponse;
use Ivoz\Core\Domain\Service\DomainEventPublisher;
use Ivoz\Core\Application\RequestId;
use Ivoz\Core\Application\Event\CommandWasExecuted;
use Service\Encoder;

class EncoderController
{
    protected $encoder;
    protected $domainEventPublisher;
    protected $requestId;

    public function __construct(
        Encoder $encoder,
        DomainEventPublisher $domainEventPublisher,
        RequestId $requestId
    ) {
        $this->encoder = $encoder;
        $this->domainEventPublisher = $domainEventPublisher;
        $this->requestId = $requestId;
    }

    public function index()
    {
        $this->registerCommand();

        $this
            ->encoder
            ->processAction();

        return new JsonResponse([
            'status' => 'Done!'
        ]);
    }

    private function registerCommand()
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
