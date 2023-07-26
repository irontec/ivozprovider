<?php

namespace Ivoz\Provider\Application\Service\WebPortal;

use Ivoz\Provider\Domain\Model\WebPortal\WebPortalDto;
use Ivoz\Provider\Domain\Model\WebPortal\WebPortalInterface;
use Ivoz\Provider\Domain\Model\WebPortal\WebPortalRepository;
use Ivoz\Core\Domain\Service\Assembler\DtoAssembler;

class GetLogoPath
{
    public function __construct(
        private WebPortalRepository $webPortalRepository,
        private DtoAssembler $dtoAssembler,
    ) {
    }

    public function execute(
        string $hostname,
        string $hostType,
        string $logoName,
    ): string {
        $webPortal = $this
            ->webPortalRepository
            ->findByServerNameAndType(
                $hostname,
                $hostType
            );

        if (!$webPortal) {
            throw new \RuntimeException(
                'WebPortal not found',
                404
            );
        }

        /** @var WebPortalDto $webPortalDto */
        $webPortalDto = $this->dtoAssembler->toDto(
            $webPortal
        );

        $baseName = $webPortalDto->getLogoBaseName();
        if ($logoName !== $baseName) {
            throw new \RuntimeException(
                'Logo name missmatch',
                404
            );
        }

        $logoPath = $webPortalDto->getLogoPath();

        if (!$logoPath) {
            throw new \RuntimeException(
                'Logo not found',
                404
            );
        }

        return $logoPath;
    }
}
