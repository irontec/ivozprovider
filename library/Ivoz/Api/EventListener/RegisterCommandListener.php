<?php

namespace Ivoz\Api\EventListener;

use Ivoz\Core\Application\Event\CommandWasExecuted;
use Ivoz\Core\Application\RequestId;
use Ivoz\Core\Domain\Service\DomainEventPublisher;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\Exception\NotAcceptableHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class RegisterCommandListener
{
    /**
     * @var DomainEventPublisher
     */
    protected $eventPublisher;

    /**
     * @var string
     */
    protected $requestId;

    public function __construct(
        DomainEventPublisher $eventPublisher,
        RequestId $requestId
    ) {
        $this->eventPublisher = $eventPublisher;
        $this->requestId = $requestId->toString();
    }

    /**
     * Sets the applicable format to the HttpFoundation Request.
     *
     * @param GetResponseEvent $event
     *
     * @throws NotFoundHttpException
     * @throws NotAcceptableHttpException
     */
    public function onKernelRequest(GetResponseEvent $event)
    {
        /** @var Request $request */
        $request = $event->getRequest();

        $body = json_decode($request->getContent(), true);
        $attributes = $request->attributes->all();

        if (!array_key_exists('_route_params', $attributes)) {
            return;
        }

        $routeParams = $attributes['_route_params'];
        $this->triggerEvent($request->getMethod(), $routeParams, $body);

        return;
    }

    private function triggerEvent(string $method, array $routeParams, array $body = null)
    {
        if (array_key_exists('_api_collection_operation_name', $routeParams)) {
            $action = $routeParams['_api_collection_operation_name'];
        } else if(array_key_exists('_api_collection_operation_name', $routeParams)) {
            $action = $routeParams['_api_item_operation_name'];
        } else {
            return;
        }

        $event = new CommandWasExecuted(
            $this->requestId,
            'API',
            $action,
            [
                'params' => $routeParams,
                'body' => $body
            ]
        );

        $this->eventPublisher->publish($event);
    }
}
