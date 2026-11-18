<?php

declare(strict_types=1);

namespace Ivoz\Provider\Application\Service\User;

use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Ivoz\Provider\Domain\Model\User\UserRepository;
use Ivoz\Provider\Domain\Service\User\CsvRowFormatter;
use Ivoz\Provider\Domain\Service\User\CsvRowsWriter;
use Ivoz\Provider\Domain\Service\User\CsvStaticValidator;

class ExportToCsv
{
    public function __construct(
        private UserRepository $userRepository,
        private CsvRowFormatter $csvRowFormatter,
        private CsvStaticValidator $csvStaticValidator,
        private CsvRowsWriter $csvRowsWriter
    ) {
    }

    /**
     * @throws \DomainException
     */
    public function execute(CompanyInterface $company): string
    {
        $users = $this->userRepository->findByCompany(
            (int) $company->getId()
        );

        $rows = array_values(
            array_map(
                fn (UserInterface $user): array => $this->csvRowFormatter->execute($user),
                $users
            )
        );

        $this->csvStaticValidator->execute($rows);

        return $this->csvRowsWriter->execute(
            [CsvStaticValidator::COLUMNS, ...$rows]
        );
    }
}
