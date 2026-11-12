<?php

declare(strict_types=1);

namespace Ivoz\Provider\Application\Service\Contact;

use Ivoz\Core\Domain\Service\EntityTools;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Contact\ContactsMassImportResult;
use Ivoz\Provider\Domain\Service\Contact\ContactFactory;
use Ivoz\Provider\Domain\Service\Contact\CsvRowsParser;
use Ivoz\Provider\Domain\Service\Contact\CsvStaticValidator;

class SyncFromCsv
{
    public function __construct(
        private ContactFactory $contactFactory,
        private EntityTools $entityTools,
        private CsvStaticValidator $csvStaticValidator,
        private CsvRowsParser $csvRowsParser
    ) {
    }

    public function execute(CompanyInterface $company, string $csv): ContactsMassImportResult
    {
        $result = new ContactsMassImportResult();

        try {
            $rows = $this->csvRowsParser->parse($csv);
            $headerKey = (int) array_key_first($rows);
            $header = $rows[$headerKey];
            unset($rows[$headerKey]);

            $this
                ->csvStaticValidator
                ->execute($header);
        } catch (\DomainException $e) {
            $result->addError(ContactsMassImportResult::FILE_LINE, $e->getMessage());

            return $result;
        }

        foreach ($rows as $k => $fields) {
            try {
                $this->importRow(
                    $company,
                    $header,
                    $fields,
                    $result
                );
            } catch (\DomainException | \InvalidArgumentException $e) {
                $result->addError($k + 1, $e->getMessage());
            }
        }

        return $result;
    }

    /**
     * @param string[] $header
     * @param string[] $fields
     * @throws \DomainException
     */
    private function importRow(
        CompanyInterface $company,
        array $header,
        array $fields,
        ContactsMassImportResult $result
    ): void {
        $hasHeaderColumns = count($fields) === count($header);
        if (!$hasHeaderColumns) {
            throw new \DomainException(
                sprintf(
                    '%d columns were expected but %d found',
                    count($header),
                    count($fields)
                )
            );
        }

        $contact = $this->contactFactory->fromMassProvisioningCsv(
            $company,
            array_combine($header, $fields)
        );
        $isNew = !$contact->getId();

        $this->entityTools->persist($contact, true);

        if ($isNew) {
            $result->addCreatedContact();
        } else {
            $result->addUpdatedContact();
        }
    }
}
