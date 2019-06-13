<?php

namespace Ivoz\Core\Infrastructure\Symfony\HttpFoundation;

use Symfony\Component\HttpFoundation\RequestStack;

class RequestDateTimeResolver
{
    private $requestStack;
    private $defaultTimeZone;
    private $queryArgument;

    public function __construct(
        RequestStack $requestStack,
        string $defaultTimeZone = 'UTC',
        string $queryArgument = '_timezone'
    ) {
        $this->requestStack = $requestStack;
        $this->defaultTimeZone = $defaultTimeZone;
        $this->queryArgument = $queryArgument;
    }

    public function getTimezone(): \DateTimeZone
    {
        $reqTimezone = $this->getRequestTimeZone();
        if ($reqTimezone) {
            return $reqTimezone;
        }

        return new \DateTimeZone(
            $this->defaultTimeZone
        );
    }

    private function getRequestTimeZone()
    {
        $request = $this->requestStack->getCurrentRequest();
        if (!$request) {
            return;
        }

        $timezone = $request->query->get(
            $this->queryArgument,
            null
        );

        if (!$timezone) {
            return;
        }

        return new \DateTimeZone($timezone);
    }
}
