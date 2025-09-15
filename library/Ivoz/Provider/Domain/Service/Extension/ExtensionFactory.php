<?php

namespace Ivoz\Provider\Domain\Service\Extension;

use Ivoz\Core\Domain\Service\EntityTools;
use Ivoz\Provider\Domain\Model\Country\CountryRepository;
use Ivoz\Provider\Domain\Model\Extension\ExtensionDto;
use Ivoz\Provider\Domain\Model\User\UserDto;
use Ivoz\Provider\Domain\Model\Extension\ExtensionInterface;
use Ivoz\Provider\Domain\Model\Extension\ExtensionRepository;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ExtensionFactory
{
    public function __construct(
        private ExtensionRepository $extensionRepository,
        private CountryRepository $countryRepository,
        private EntityTools $entityTools
    ) {
    }

    /**
     * @throws \Exception
     */
    public function fromMassProvisioningCsv(
        int $companyId,
        string $extensionNumber,
        ?UserInterface $user = null,
        ?string $countryCode = null,
        ?string $number = null,
        ?string $code = null
    ): ExtensionInterface {

        $extension = $companyId
            ? $this->extensionRepository->findCompanyExtension(
                $companyId,
                $extensionNumber
            )
            : null;

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

        if ($countryCode) {
            $country = $this->countryRepository
                ->findOneByCountryCode($countryCode, $code);

            if (!$country) {
                throw new NotFoundHttpException('Country not found');
            }

            $extensionDto
                ->setNumberCountryId(
                    $country->getId()
                )
                ->setRouteType(ExtensionInterface::ROUTETYPE_NUMBER);
        }

        if ($number) {
            $extensionDto->setNumberValue($number);
        }

        $userDto = $user
            ? $this->entityTools->entityToDto(
                $user
            )
            : null;

        /** @var UserDto $userDto */
        $extensionDto->setUser($userDto);

        /** @var ExtensionInterface $extension */
        $extension = $this->entityTools->dtoToEntity(
            $extensionDto,
            $extension
        );

        return $extension;
    }
}
