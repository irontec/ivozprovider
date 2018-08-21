<?php

namespace Controller\My;

use ApiPlatform\Core\Exception\ResourceClassNotFoundException;
use Ivoz\Core\Application\Service\Assembler\DtoAssembler;
use Ivoz\Provider\Domain\Model\BrandUrl\BrandUrl;
use Ivoz\Provider\Domain\Model\BrandUrl\BrandUrlDto;
use Ivoz\Provider\Domain\Model\BrandUrl\BrandUrlRepository;
use Model\WebTheme;
use Symfony\Component\HttpFoundation\RequestStack;

class WebThemeAction
{
    /**
     * @var DtoAssembler
     */
    protected $dtoAssembler;

    /**
     * @var BrandUrlRepository
     */
    protected $brandUrlRepository;

    /**
     * @var RequestStack
     */
    protected $requestStack;

    public function __construct (
        DtoAssembler $dtoAssembler,
        BrandUrlRepository $brandUrlRepository,
        RequestStack $requestStack
    ) {
        $this->dtoAssembler = $dtoAssembler;
        $this->brandUrlRepository = $brandUrlRepository;
        $this->requestStack = $requestStack;
    }

    public function __invoke()
    {
        $request = $this->requestStack->getCurrentRequest();
        $where = [
            'url' => 'https://' . $request->server->get('SERVER_NAME'),
            'urlType' => 'user'
        ];
        /** @var BrandUrl $brandUrl */
        $brandUrl = $this->brandUrlRepository->findOneBy($where);

        if (!$brandUrl) {
            throw new ResourceClassNotFoundException('BrandUrl not found');
        }

        /** @var BrandUrlDto $brandUrlDto */
        $brandUrlDto = $this->dtoAssembler->toDto($brandUrl);

        $publicLogoUrl =
            'https://'
            . $request->server->get('SERVER_NAME')
            . '/fso/brandUrl/'
            . $brandUrlDto->getId()
            . '-'
            . $brandUrlDto->getLogoBaseName();

        return new WebTheme(
            $brandUrlDto->getName(),
            $brandUrlDto->getUserTheme(),
            $publicLogoUrl
        );
    }
}