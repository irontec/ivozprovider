<?php

namespace Controller\My;

use Ivoz\Provider\Application\Service\WebPortal\GetLogoPath;
use Ivoz\Provider\Domain\Model\WebPortal\WebPortalInterface;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class LogoAction
{
    public function __construct(
        private GetLogoPath $getLogoPath,
    ) {
    }

    public function __invoke(Request $request): Response
    {
        $hostname = $request->getHost();
        $logoName = (string) $request->attributes->get('name');

        $logoPath = $this
            ->getLogoPath
            ->execute(
                $hostname,
                WebPortalInterface::URLTYPE_BRAND,
                $logoName
            );

        return new BinaryFileResponse(
            $logoPath
        );
    }
}
