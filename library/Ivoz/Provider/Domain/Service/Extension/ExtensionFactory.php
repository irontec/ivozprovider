<?php

namespace Ivoz\Provider\Domain\Service\Extension;

use Ivoz\Core\Domain\Service\EntityTools;
use Ivoz\Provider\Domain\Model\Extension\ExtensionDto;
use Ivoz\Provider\Domain\Model\Extension\ExtensionInterface;
use Ivoz\Provider\Domain\Model\Extension\ExtensionRepository;
use Ivoz\Provider\Domain\Model\User\UserInterface;

class ExtensionFactory
{
    public function __construct(
        private ExtensionRepository $extensionRepository,
        private EntityTools $entityTools
    ) {
    }

    /**
     * @throws \Exception
     */
    public function fromMassProvisioningCsv(
        int $companyId,
        string $extensionNumber,
        UserInterface $user
    ): ExtensionInterface {

        $extension = $this->extensionRepository->findCompanyExtension(
            $companyId,
            $extensionNumber
        );

        /** @var ExtensionDto $extensionDto */
        $extensionDto = $extension instanceof ExtensionInterface
            ? $this->entityTools->entityToDto($extension)
            : new ExtensionDto();

        $extensionDto
            ->setCompanyId($companyId)
            ->setNumber($extensionNumber)
            ->setRouteType(
                ExtensionInterface::ROUTETYPE_USER
            );

        /** @var ExtensionInterface $extension */
        $extension = $this->entityTools->dtoToEntity(
            $extensionDto,
            $extension
        );

        $extension
            ->setUser($user);

        return $extension;
    }
}
