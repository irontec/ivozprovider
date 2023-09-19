<?php

use Ivoz\Provider\Domain\Model\WebPortal\WebPortalInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Ivoz\Provider\Domain\Model\WebPortal\WebPortalRepository;

class RouterController
{
    public function __construct(
        private WebPortalRepository $webPortalRepository
    ) {
    }

    public function index(Request $request): RedirectResponse
    {
        $webPortal = $this->webPortalRepository->findByServerName(
            $request->server->get('SERVER_NAME')
        );

        if ($webPortal && !$webPortal->getNewUI()) {
            return new RedirectResponse('/classic');
        }

        $targetUrl = match ($webPortal?->getUrlType()) {
            WebPortalInterface::URLTYPE_USER => '/user',
            WebPortalInterface::URLTYPE_ADMIN => '/client',
            WebPortalInterface::URLTYPE_BRAND => '/brand',
            default => '/platform',
        };

        return new RedirectResponse($targetUrl);
    }
}
