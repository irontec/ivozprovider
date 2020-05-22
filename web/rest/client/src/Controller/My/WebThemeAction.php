<?php

namespace Controller\My;

use ApiPlatform\Core\Exception\ResourceClassNotFoundException;
use Ivoz\Core\Application\Service\Assembler\DtoAssembler;
use Ivoz\Provider\Domain\Model\WebPortal\WebPortal;
use Ivoz\Provider\Domain\Model\WebPortal\WebPortalDto;
use Ivoz\Provider\Domain\Model\WebPortal\WebPortalRepository;
use Model\WebTheme;
use Symfony\Component\HttpFoundation\RequestStack;

class WebThemeAction
{
    /**
     * @var DtoAssembler
     */
    protected $dtoAssembler;

    /**
     * @var WebPortalRepository
     */
    protected $webPortalRepository;

    /**
     * @var RequestStack
     */
    protected $requestStack;

    public function __construct(
        DtoAssembler $dtoAssembler,
        WebPortalRepository $webPortalRepository,
        RequestStack $requestStack
    ) {
        $this->dtoAssembler = $dtoAssembler;
        $this->webPortalRepository = $webPortalRepository;
        $this->requestStack = $requestStack;
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
            . $webPortalDto->getId()
            . '-'
            . urlencode($webPortalDto->getLogoBaseName());

        return new WebTheme(
            $webPortalDto->getName(),
            $webPortalDto->getUserTheme(),
            $publicLogoUrl
        );
    }
}
