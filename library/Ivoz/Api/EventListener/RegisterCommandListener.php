<?php

namespace Ivoz\Api\EventListener;

use Ivoz\Core\Application\Event\CommandWasExecuted;
use Ivoz\Core\Application\RequestId;
use Ivoz\Core\Domain\Service\DomainEventPublisher;
use Lexik\Bundle\JWTAuthenticationBundle\Security\Guard\JWTTokenAuthenticator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\HttpKernel\Exception\NotAcceptableHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Lexik\Bundle\JWTAuthenticationBundle\Security\Authentication\Token\PreAuthenticationJWTUserToken;

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

    /**
     * @var JWTTokenAuthenticator
     */
    protected $jwtTokenAuthenticator;

    public function __construct(
        DomainEventPublisher $eventPublisher,
        RequestId $requestId,
        JWTTokenAuthenticator $jwtTokenAuthenticator
    ) {
        $this->eventPublisher = $eventPublisher;
        $this->requestId = $requestId->toString();
        $this->jwtTokenAuthenticator = $jwtTokenAuthenticator;
    }

    /**
     * Sets the applicable format to the HttpFoundation Request.
     *
     * @param GetResponseEvent $event
     *
     * @throws NotFoundHttpException
     * @throws NotAcceptableHttpException
     */
    public function onKernelView(GetResponseForControllerResultEvent $event)
    {
        /** @var Request $request */
        $request = $event->getRequest();

        $body = json_decode($request->getContent(), true);
        $attributes = $request->attributes->all();

        if (!array_key_exists('_route_params', $attributes)) {
            return;
        }

        $routeParams = $attributes['_route_params'];
        $credentials = $this->jwtTokenAuthenticator->getCredentials($request);
        $this->triggerEvent(
            $routeParams,
            $body,
            $credentials
        );

        return;
    }

    private function triggerEvent(
        array $routeParams,
        array $body = null,
        PreAuthenticationJWTUserToken $credentials = null
    ) {
        if (array_key_exists('_api_collection_operation_name', $routeParams)) {
            $action = $routeParams['_api_collection_operation_name'];
        } elseif (array_key_exists('_api_item_operation_name', $routeParams)) {
            $action = $routeParams['_api_item_operation_name'];
        } else {
            return;
        }

        $auth = $credentials
            ? $credentials->getPayload()
            : null;

        $event = new CommandWasExecuted(
            $this->requestId,
            'API',
            $action,
            [
                'auth' => $auth,
                'operation' => $routeParams
            ]
        );

        $this->eventPublisher->publish($event);
    }
}
