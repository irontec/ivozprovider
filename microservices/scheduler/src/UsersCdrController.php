<?php

use Ivoz\Core\Domain\RegisterCommandTrait;
use Ivoz\Core\Domain\RequestId;
use Ivoz\Core\Domain\Service\DomainEventPublisher;
use Ivoz\Provider\Application\Service\UsersCdr\MigrateFromUnparsedKamUsersCdr;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Response;

class UsersCdrController
{
    use RegisterCommandTrait;

    public function __construct(
        private MigrateFromUnparsedKamUsersCdr $migrateUnparsedKamUsersCdrs,
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
            $this->registerCommand('Scheduler', 'usersCdr');
            $this->migrateUnparsedKamUsersCdrs->execute();
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
            return new Response(
                $e->getMessage() . "\n",
                500
            );
        }

        return new Response("UsersCDR migration done!\n", 200);
    }
}
