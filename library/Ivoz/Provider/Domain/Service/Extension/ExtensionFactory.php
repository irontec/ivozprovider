<?php

namespace Ivoz\Provider\Domain\Service\Extension;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\Extension\ExtensionDto;
use Ivoz\Provider\Domain\Model\Extension\ExtensionInterface;
use Ivoz\Provider\Domain\Model\Extension\ExtensionRepository;
use Ivoz\Provider\Domain\Model\User\UserInterface;

class ExtensionFactory
{
    protected $extensionRepository;
    protected $entityTools;

    public function __construct(
        ExtensionRepository $extensionRepository,
        EntityTools $entityTools
    ) {
        $this->extensionRepository = $extensionRepository;
        $this->entityTools = $entityTools;
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

        if ($extension) {
            return $extension;
        }

        $extensionDto = new ExtensionDto();
        $extensionDto
            ->setCompanyId($companyId)
            ->setNumber($extensionNumber)
            ->setRouteType(
                ExtensionInterface::ROUTETYPE_USER
            )
            ->setUserId(
                $user->getId()
            );

        $extension = $this->entityTools->dtoToEntity(
            $extensionDto
        );

        return $extension;
    }
}
