<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Service\Contact;

class CsvStaticValidator
{
    public const COLUMNS = [
        'id',
        'name',
        'lastname',
        'email',
        'workPhoneCountry',
        'workPhone',
        'mobilePhoneCountry',
        'mobilePhone',
        'otherPhone',
    ];

    /**
     * @param string[] $header
     * @throws \DomainException
     */
    public function execute(array $header): void
    {
        foreach ($header as $column) {
            $isKnownColumn = in_array($column, self::COLUMNS, true);
            if (!$isKnownColumn) {
                throw new \DomainException(
                    sprintf(
                        'Unknown column "%s" in the header. Allowed columns: %s',
                        $column,
                        implode(', ', self::COLUMNS)
                    )
                );
            }
        }
    }
}
