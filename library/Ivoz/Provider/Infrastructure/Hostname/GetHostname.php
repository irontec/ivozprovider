<?php

namespace Ivoz\Provider\Infrastructure\Hostname;

use Ivoz\Provider\Domain\Service\HostnameGetter;
use Symfony\Component\HttpFoundation\RequestStack;

class GetHostname implements HostnameGetter
{
    public function __construct(
        private RequestStack $requestStack
    ) {
    }

    public function __invoke(): ?string
    {
        return $this->requestStack->getCurrentRequest()?->getHost();
    }
}
