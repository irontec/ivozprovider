<?php

namespace Ivoz\Core\Infrastructure\Symfony\EventListener;

use Assert\InvalidArgumentException;
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
        $exceptionClass = get_class($exception);
        $publicExceptions = [
            \DomainException::class,
            InvalidArgumentException::class
        ];

        if (!in_array($exceptionClass, $publicExceptions)) {
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
