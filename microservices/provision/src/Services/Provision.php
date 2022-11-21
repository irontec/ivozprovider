<?php

namespace Services;

use Ivoz\Provider\Domain\Model\TerminalModel\TerminalModelRepository;

class Provision
{
    public function __construct(
        private TerminalModelRepository $terminalModelRepository,
        private ProvisionGeneric $provisionGeneric,
        private ProvisionSpecific $provisionSpecific,
    ) {
    }

    public function execute(
        bool $isHttps,
        string $route
    ): string {

        $terminalModel = $this
            ->terminalModelRepository
            ->findOneByGenericUrlPattern($route);

        if ($terminalModel) {
            // Generic Template requests must be served over HTTP
            if ($isHttps) {
                throw new \DomainException('No generic provisioning over https', 403);
            }

            return $this
                ->provisionGeneric
                ->execute($terminalModel);
        }

        if (! $isHttps) {
            // Specific Template requests must be served over HTTPS
            throw new \DomainException('Terminal model not found', 404);
        }

        $routeSegments = explode('/', $route);
        $mac = array_pop($routeSegments);

        return $this
            ->provisionSpecific
            ->execute($mac);
    }
}
