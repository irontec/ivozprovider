<?php

namespace Controller\My;

use Ivoz\Provider\Application\Service\WebPortal\WebThemeFactory;
use Ivoz\Provider\Domain\Model\WebPortal\WebPortalInterface;
use Ivoz\Provider\Domain\Model\WebPortal\WebTheme;
use Symfony\Component\HttpFoundation\Request;

class WebThemeAction
{
    public function __construct(
        private WebThemeFactory $webThemeFactory
    ) {
    }

    public function __invoke(Request $request): WebTheme
    {
        $hostname = $request->getHost();

        return $this
            ->webThemeFactory
            ->execute(
                $hostname,
                WebPortalInterface::URLTYPE_USER
            );
    }
}
