<?php

declare(strict_types=1);

namespace Ivoz\Provider\Application\Service\Ddi;

use Ivoz\Core\Domain\Service\EntityTools;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Country\CountryInterface;
use Ivoz\Provider\Domain\Model\Ddi\DdiDto;
use Ivoz\Provider\Domain\Model\Ddi\DdiInterface;
use Ivoz\Provider\Domain\Model\Ddi\DdiRepository;
use Ivoz\Provider\Domain\Model\Ddi\DdisMassImportResult;
use Ivoz\Provider\Domain\Model\DdiProvider\DdiProviderInterface;
use Ivoz\Provider\Domain\Service\Ddi\CsvRowsParser;
use Psr\Log\LoggerInterface;

class SyncFromCsv
{
    public function __construct(
        private CsvRowsParser $csvRowsParser,
        private DdiRepository $ddiRepository,
        private EntityTools $entityTools,
        private LoggerInterface $logger
    ) {
    }

    public function execute(
        BrandInterface $brand,
        CountryInterface $country,
        ?CompanyInterface $company,
        ?DdiProviderInterface $ddiProvider,
        string $csv
    ): DdisMassImportResult {
        $result = new DdisMassImportResult();

        try {
            $rows = $this->csvRowsParser->parse($csv);
        } catch (\DomainException $e) {
            $result->addError(DdisMassImportResult::FILE_LINE, $e->getMessage());

            return $result;
        }

        $processedNumbers = [];
        foreach ($rows as $k => $number) {
            $line = $k + 1;

            $isRepeated = in_array($number, $processedNumbers, true);
            if ($isRepeated) {
                $result->addSkipped($line, 'Repeated in the file');
                continue;
            }
            $processedNumbers[] = $number;

            try {
                $this->importRow($brand, $country, $company, $ddiProvider, $number, $line, $result);
            } catch (\DomainException | \InvalidArgumentException $e) {
                $result->addError($line, $e->getMessage());
            } catch (\Throwable $e) {
                $this->logger->error(
                    sprintf('DDIs mass import stopped at line %d: %s', $line, $e->getMessage()),
                    ['exception' => $e]
                );
                $result->addError($line, 'Unknown error');
                $this->markRemainingRowsAsNotProcessed($rows, $line, $result);

                return $result;
            }
        }

        return $result;
    }

    /**
     * @param array<int, string> $rows
     */
    private function markRemainingRowsAsNotProcessed(
        array $rows,
        int $failedLine,
        DdisMassImportResult $result
    ): void {
        $message = sprintf(
            'Not processed: the import stopped after an unexpected error at line %d',
            $failedLine
        );

        foreach (array_keys($rows) as $k) {
            $line = $k + 1;
            if ($line <= $failedLine) {
                continue;
            }

            $result->addError($line, $message);
        }
    }

    /**
     * @throws \DomainException
     * @throws \InvalidArgumentException
     */
    private function importRow(
        BrandInterface $brand,
        CountryInterface $country,
        ?CompanyInterface $company,
        ?DdiProviderInterface $ddiProvider,
        string $number,
        int $line,
        DdisMassImportResult $result
    ): void {
        $ddi = $this
            ->ddiRepository
            ->findOneByDdiAndCountry($number, (int) $country->getId());

        if (!$ddi) {
            $this->create($brand, $country, $company, $ddiProvider, $number);
            $result->addCreated();

            return;
        }

        $isOtherBrandDdi = (int) $ddi->getBrand()->getId() !== (int) $brand->getId();
        if ($isOtherBrandDdi) {
            $result->addSkipped($line, 'DDI already exists');

            return;
        }

        $conflict = $this->conflictReason($ddi, $company, $ddiProvider);
        if ($conflict !== null) {
            $result->addSkipped($line, $conflict);

            return;
        }

        $companyToFill = $ddi->getCompany() === null ? $company : null;
        $ddiProviderToFill = $ddi->getDdiProvider() === null ? $ddiProvider : null;

        $nothingToFill = $companyToFill === null && $ddiProviderToFill === null;
        if ($nothingToFill) {
            $result->addSkipped($line, 'Nothing to update');

            return;
        }

        $this->fill($ddi, $companyToFill, $ddiProviderToFill);
        $result->addUpdated($line);
    }

    private function conflictReason(
        DdiInterface $ddi,
        ?CompanyInterface $company,
        ?DdiProviderInterface $ddiProvider
    ): ?string {
        $currentCompany = $ddi->getCompany();
        $isOtherCompany = $company !== null
            && $currentCompany !== null
            && $currentCompany->getId() !== $company->getId();
        if ($isOtherCompany) {
            return 'DDI already assigned to another client';
        }

        $currentDdiProvider = $ddi->getDdiProvider();
        $isOtherDdiProvider = $ddiProvider !== null
            && $currentDdiProvider !== null
            && $currentDdiProvider->getId() !== $ddiProvider->getId();
        if ($isOtherDdiProvider) {
            return 'DDI already assigned to another DDI provider';
        }

        $isOutboundOnlyWithProvider = $ddiProvider !== null
            && $ddi->getType() === DdiInterface::TYPE_OUT;
        if ($isOutboundOnlyWithProvider) {
            return 'Outbound only DDIs cannot have a DDI provider';
        }

        return null;
    }

    private function create(
        BrandInterface $brand,
        CountryInterface $country,
        ?CompanyInterface $company,
        ?DdiProviderInterface $ddiProvider,
        string $number
    ): void {
        $ddiDto = (new DdiDto())
            ->setDdi($number)
            ->setType(DdiInterface::TYPE_INOUT)
            ->setCountryId((int) $country->getId())
            ->setBrandId((int) $brand->getId())
            ->setCompanyId($company?->getId())
            ->setDdiProviderId($ddiProvider?->getId());

        $ddi = $this->entityTools->dtoToEntity($ddiDto);
        $this->entityTools->persist($ddi, true);
    }

    private function fill(
        DdiInterface $ddi,
        ?CompanyInterface $company,
        ?DdiProviderInterface $ddiProvider
    ): void {
        /** @var DdiDto $ddiDto */
        $ddiDto = $this->entityTools->entityToDto($ddi);

        if ($company !== null) {
            $ddiDto->setCompanyId($company->getId());
        }

        if ($ddiProvider !== null) {
            $ddiDto->setDdiProviderId($ddiProvider->getId());
        }

        $this->entityTools->updateEntityByDto($ddi, $ddiDto);
        $this->entityTools->persist($ddi, true);
    }
}
