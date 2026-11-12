<?php

namespace Ivoz\Provider\Domain\Service\Extension;

use Ivoz\Core\Domain\Service\EntityTools;
use Ivoz\Provider\Domain\Model\Country\CountryRepository;
use Ivoz\Provider\Domain\Model\Extension\ExtensionDto;
use Ivoz\Provider\Domain\Model\Extension\ExtensionInterface;
use Ivoz\Provider\Domain\Model\Extension\ExtensionRepository;
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
            $this->routeToNumber($extensionDto, $countryCode, $code);
        }

        if ($number) {
            $extensionDto->setNumberValue($number);
        }

        /** @var ExtensionInterface $extension */
        $extension = $this->entityTools->dtoToEntity(
            $extensionDto,
            $extension
        );

        return $extension;
    }

    /**
     * @throws NotFoundHttpException
     */
    private function routeToNumber(
        ExtensionDto $extensionDto,
        string $countryCode,
        ?string $code
    ): void {
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
}
