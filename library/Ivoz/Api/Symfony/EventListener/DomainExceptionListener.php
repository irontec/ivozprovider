<?php

namespace Ivoz\Api\Symfony\EventListener;

use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use ApiPlatform\Core\Util\ErrorFormatGuesser;
use Assert\InvalidArgumentException;
use Symfony\Component\Serializer\SerializerInterface;

class DomainExceptionListener
{
    private $serializer;
    private $logger;
    private $errorFormats;

    public function __construct(
        SerializerInterface $serializer,
        LoggerInterface $logger,
        array $errorFormats
    ) {
        $this->serializer = $serializer;
        $this->logger = $logger;
        $this->errorFormats = $errorFormats;
    }

    /**
     * Returns formatted error message
     *
     * @param GetResponseForExceptionEvent $event
     * @return void
     */
    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        $exception = $event->getException();
        $this->logger->error($exception->getMessage());

        $exceptionClass = get_class($exception);
        $publicExceptions = [
            \DomainException::class,
            InvalidArgumentException::class,
            \RuntimeException::class
        ];

        if (!in_array($exceptionClass, $publicExceptions)) {
            return;
        }

        $format = ErrorFormatGuesser::guessErrorFormat($event->getRequest(), $this->errorFormats);
        $event->setException($exception);
        $responseCode = $exception->getCode() > 0
            ? $exception->getCode()
            : Response::HTTP_BAD_REQUEST;

        $body = $this->serializer->serialize($exception, $format['key']);
        $event->setResponse(new Response(
            $body,
            $responseCode,
            [
                'Content-Type' => sprintf('%s; charset=utf-8', $format['value'][0]),
                'X-Content-Type-Options' => 'nosniff',
                'X-Frame-Options' => 'deny',
            ]
        ));
        $event->stopPropagation();
    }
}
