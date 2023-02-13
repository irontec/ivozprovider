<?php

namespace Controller\My;

use ApiPlatform\Core\Exception\ResourceClassNotFoundException;
use Ivoz\Core\Domain\Service\Assembler\DtoAssembler;
use Ivoz\Provider\Domain\Model\WebPortal\WebPortal;
use Ivoz\Provider\Domain\Model\WebPortal\WebPortalDto;
use Ivoz\Provider\Domain\Model\WebPortal\WebPortalRepository;
use Model\WebTheme;
use Symfony\Component\HttpFoundation\RequestStack;

class WebThemeAction
{
    public function __construct(
        private DtoAssembler $dtoAssembler,
        private WebPortalRepository $webPortalRepository,
        private RequestStack $requestStack
    ) {
    }

    public function __invoke()
    {
        $request = $this->requestStack->getCurrentRequest();

        $webPortal = $this->webPortalRepository->findUserUrlByServerName(
            $request->server->get('SERVER_NAME')
        );

        if (!$webPortal) {
            throw new ResourceClassNotFoundException('WebPortal not found');
        }

        /** @var WebPortalDto $webPortalDto */
        $webPortalDto = $this->dtoAssembler->toDto($webPortal);

        $publicLogoUrl =
            'https://'
            . $request->server->get('SERVER_NAME')
            . '/fso/webPortal/'
            . (string) $webPortalDto->getId()
            . '-'
            . urlencode($webPortalDto->getLogoBaseName());

        return new WebTheme(
            $webPortalDto->getName(),
            $webPortalDto->getUserTheme(),
            $publicLogoUrl
        );
    }
}
