<?php

namespace Ivoz\Provider\Domain\Service\Extension;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Core\Domain\Assert\Assertion;
use Ivoz\Provider\Domain\Model\Country\CountryRepository;
use Ivoz\Provider\Domain\Model\Extension\Extension;
use Ivoz\Provider\Domain\Model\Extension\ExtensionDto;
use Ivoz\Provider\Domain\Model\Extension\ExtensionInterface;
use Ivoz\Provider\Domain\Model\Extension\ExtensionRepository;

class AliasImporter
{
    public function __construct(
        private EntityTools $entityTools,
        private CountryRepository $countryRepository,
        private ExtensionRepository $extensionRepository
    ) {
    }

    /**
     * @param int $companyId
     * @param array $data
     *
     * @throws \Exception
     *
     * @return void
     */
    public function execute(int $companyId, array $data): void
    {
        $this->assertValidData($data);

        foreach ($data as $line) {
            [$extensionNumber, $countryPrefix, $number] = $line;
            $countryIden = $line[3] ?? null;

            $this->queueForPersist(
                $companyId,
                (string) $extensionNumber,
                $countryPrefix,
                (string) $number,
                $countryIden
            );
        }

        $this
            ->entityTools
            ->dispatchQueuedOperations();
    }

    private function assertValidData(array $data): void
    {
        Assertion::notEmpty(
            $data,
            'Empty alias list found'
        );

        foreach ($data as $lineNum => $line) {
            $columnNumber = count($line);
            Assertion::greaterOrEqualThan(
                $columnNumber,
                3,
                'CSV column number should be equal or greater than 3 at line ' . $lineNum
            );

            Assertion::lessOrEqualThan(
                $columnNumber,
                4,
                'CSV column number should be equal or lower than 4 at line ' . $lineNum
            );

            [$extensionNumber, $countryPrefix, $number] = $line;
            $countryIden = $line[4] ?? null;

            Assertion::integerish(
                $extensionNumber,
                'Extension number should be numeric at line ' . $lineNum
            );

            Assertion::regex(
                $countryPrefix,
                '/^\+[0-9]+/',
                'Country prefix ' . $countryPrefix . ' does not match expected format at line ' . $lineNum
            );

            Assertion::integerish(
                $number,
                'Number should be numeric at line ' . $lineNum
            );

            if (!is_null($countryIden)) {
                Assertion::regex(
                    $countryIden,
                    '/^[A-Za-z]+/',
                    'Country identifier ' . $countryIden . ' does not match expected format at line ' . $lineNum
                );
            }
        }
    }

    private function queueForPersist(
        int $companyId,
        string $extensionNumber,
        string $countryPrefix,
        string $numberValue,
        string $countryIden = null
    ): void {
        $country = $this->countryRepository->findOneByCountryCode(
            $countryPrefix,
            $countryIden
        );

        if (!$country) {
            $countryIdentifier = $countryPrefix;
            if ($countryIden) {
                $countryIdentifier .= '(' . $countryIden . ')';
            }
            $errorMsg = 'Country code ' . $countryIdentifier . ' was not found';

            throw new \DomainException($errorMsg);
        }

        $extension = $this
            ->extensionRepository
            ->findCompanyExtension(
                $companyId,
                $extensionNumber
            );

        if (!is_null($extension)) {
            $this->assertExtensionCanBeUpdated(
                $extensionNumber,
                $extension
            );
        }

        /** @var ExtensionDto $extensionDto */
        $extensionDto = $extension
            ? $this->entityTools->entityToDto($extension)
            : Extension::createDto();

        $extensionDto
            ->setNumber(
                $extensionNumber
            )
            ->setRouteType(
                ExtensionInterface::ROUTETYPE_NUMBER
            )
            ->setNumberValue(
                $numberValue
            )
            ->setNumberCountryId(
                $country->getId()
            )
            ->setCompanyId(
                $companyId
            );

        $this
            ->entityTools
            ->persistDto(
                $extensionDto,
                $extension,
                false
            );
    }

    private function assertExtensionCanBeUpdated(
        string $extensionNumber,
        ExtensionInterface $extension
    ): void {
        $errorMsg =
            'Unable to update extension '
            . $extensionNumber
            . ' because it already exists and its route type is not number';

        Assertion::eq(
            $extension->getRouteType(),
            ExtensionInterface::ROUTETYPE_NUMBER,
            $errorMsg
        );
    }
}
