<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Service\Contact;

use Ivoz\Provider\Domain\Model\Contact\ContactDto;
use Ivoz\Provider\Domain\Model\Country\CountryInterface;
use Ivoz\Provider\Domain\Model\Country\CountryRepository;

class CsvRowFormatter
{
    public function __construct(
        private CountryRepository $countryRepository
    ) {
    }

    /**
     * @return array<string, int|string|null> values by column, in CsvStaticValidator::COLUMNS order
     */
    public function execute(ContactDto $contactDto): array
    {
        return [
            'id' => $contactDto->getId(),
            'name' => $contactDto->getName() ?? '',
            'lastname' => $contactDto->getLastname() ?? '',
            'email' => $contactDto->getEmail() ?? '',
            'workPhoneCountry' => $this->countryCode($contactDto->getWorkPhoneCountryId()),
            'workPhone' => $contactDto->getWorkPhone() ?? '',
            'mobilePhoneCountry' => $this->countryCode($contactDto->getMobilePhoneCountryId()),
            'mobilePhone' => $contactDto->getMobilePhone() ?? '',
            'otherPhone' => $contactDto->getOtherPhone() ?? '',
        ];
    }

    private function countryCode(?int $countryId): string
    {
        if ($countryId === null) {
            return '';
        }

        /** @var CountryInterface|null $country */
        $country = $this->countryRepository->find($countryId);

        return $country?->getCode() ?? '';
    }
}
