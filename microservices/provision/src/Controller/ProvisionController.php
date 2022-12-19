<?php

namespace Controller;

use Psr\Log\LoggerInterface;
use Services\Provision;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Ivoz\Core\Domain\Service\DomainEventPublisher;
use Ivoz\Core\Application\RequestId;
use Ivoz\Core\Application\RegisterCommandTrait;

class ProvisionController
{
    use RegisterCommandTrait;

    public function __construct(
        DomainEventPublisher $eventPublisher,
        RequestId $requestId,
        private Provision $provision,
        private LoggerInterface $logger
    ) {
        $this->eventPublisher = $eventPublisher;
        $this->requestId = $requestId;
    }

    public function indexAction(Request $request): Response
    {
        $isHttps = $request->getScheme() === 'https';
        if ($isHttps && $request->getPort() == 443) {
            throw new \DomainException('No generic provisioning over 443', 403);
        }

        /** @var array{params: string} $routeParams */
        $routeParams = $request->attributes->get('_route_params');

        try {
            $content = $this->provision->execute(
                $isHttps,
                $routeParams['params']
            );
        } catch (\DomainException $e) {
            $this->logger->error(
                $e->getMessage()
            );

            return new Response(
                $e->getMessage() . "\n",
                $e->getCode()
            );
        } catch (\Exception $e) {
            $this->logger->error(
                $e->getMessage()
            );

            return new Response(
                'Server error',
                500
            );
        }

        return new Response($content, 200);
    }
}
