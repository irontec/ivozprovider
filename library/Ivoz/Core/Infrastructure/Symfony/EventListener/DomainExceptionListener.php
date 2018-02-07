<?php

namespace Ivoz\Core\Infrastructure\Symfony\EventListener;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;

class DomainExceptionListener
{
    /**
     * @param GetResponseForExceptionEvent $event
     * @return void
     */
    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        $exception = $event->getException();
        if (!$exception instanceof \DomainException) {
            return;
        }

        $event->setResponse(new Response(
            $exception->getMessage(),
            $exception->getCode() ?? Response::HTTP_FAILED_DEPENDENCY,
            [
                'X-Content-Type-Options' => 'nosniff',
                'X-Frame-Options' => 'deny',
            ]
        ));
        $event->stopPropagation();
    }
}