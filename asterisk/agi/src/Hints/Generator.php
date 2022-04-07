<?php

namespace Hints;

use RouteHandlerAbstract;

class Generator extends RouteHandlerAbstract
{
    public function __construct(
        private ExtensionHintsGenerator $extensionHintsGenerator,
        private RouteLockHintsGenerator $routeLockHintsGenerator,
    ) {
    }

    public function process(): void
    {
        // Extension related hints
        $this
            ->extensionHintsGenerator
            ->process();

        // RouteLock related hints
        $this
            ->routeLockHintsGenerator
            ->process();
    }
}
