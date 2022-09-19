<?php

namespace Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Ivoz\Core\Domain\Service\DomainEventPublisher;
use Ivoz\Core\Application\RequestId;
use Ivoz\Core\Application\RegisterCommandTrait;
use Services\Provision;

class ProvisionController
{
    use RegisterCommandTrait;

    public function __construct(
        DomainEventPublisher $eventPublisher,
        RequestId $requestId,
        private Provision $provision
    ) {
        $this->eventPublisher = $eventPublisher;
        $this->requestId = $requestId;
    }

    public function indexAction(Request $request): Response
    {
        try {
            $this->registerCommand('Provision', 'indexAction');
            $configFile = $request->attributes->get('_route_params')['configFile'];

            $content = $this->provision->execute($configFile);
        } catch (\Exception $e) {
            return new Response(
                $e->getMessage() . "\n",
                500
            );
        }

        return new Response( (string) $content, 200);
    }
}
