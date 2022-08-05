<?php

use Symfony\Component\HttpFoundation\Response;
use Ivoz\Core\Domain\Service\DomainEventPublisher;
use Ivoz\Core\Application\RequestId;
use Ivoz\Core\Application\RegisterCommandTrait;

class IndexController
{
    use RegisterCommandTrait;

    public function __construct(
        DomainEventPublisher $eventPublisher,
        RequestId $requestId,
    ) {
        $this->eventPublisher = $eventPublisher;
        $this->requestId = $requestId;
    }

    public function indexAction(): Response
    {

        try {
            $this->registerCommand('Provision', 'indexAction');
        } catch (\Exception $e) {
            return new Response(
                $e->getMessage() . "\n",
                500
            );
        }

        return new Response("Done!\n", 200);
    }
}
