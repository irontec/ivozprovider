<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Service\Contact;

use Ivoz\Core\Domain\Service\EntityTools;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Contact\ContactDto;
use Ivoz\Provider\Domain\Model\Contact\ContactInterface;
use Ivoz\Provider\Domain\Model\Contact\ContactRepository;
use Ivoz\Provider\Domain\Model\Country\CountryRepository;

class ContactFactory
{
    public function __construct(
        private ContactRepository $contactRepository,
        private CountryRepository $countryRepository,
        private EntityTools $entityTools
    ) {
    }

    /**
     * @param array<string, string> $columns values by column name, only for the columns in the file
     * @throws \DomainException
     */
    public function fromMassProvisioningCsv(
        CompanyInterface $company,
        array $columns
    ): ContactInterface {
        $contact = $this->findCompanyContact(
            $company,
            $columns['id'] ?? ''
        );

        /** @var ContactDto $contactDto */
        $contactDto = $contact
            ? $this->entityTools->entityToDto($contact)
            : (new ContactDto())->setCompanyId($company->getId());

        $isLinkedToUser = $contact?->getUser() !== null;
        if (!$isLinkedToUser) {
            $this->applyPersonalData($contactDto, $columns, !$contact);
        }

        [$workPhone, $workPhoneCountryId] = $this->resolvePhone(
            $company,
            $columns,
            'workPhone',
            'workPhoneCountry',
            $contactDto->getWorkPhone(),
            $contactDto->getWorkPhoneCountryId()
        );
        $contactDto
            ->setWorkPhone($workPhone)
            ->setWorkPhoneCountryId($workPhoneCountryId);

        [$mobilePhone, $mobilePhoneCountryId] = $this->resolvePhone(
            $company,
            $columns,
            'mobilePhone',
            'mobilePhoneCountry',
            $contactDto->getMobilePhone(),
            $contactDto->getMobilePhoneCountryId()
        );
        $contactDto
            ->setMobilePhone($mobilePhone)
            ->setMobilePhoneCountryId($mobilePhoneCountryId);

        /** @var ContactInterface $contact */
        $contact = $this->entityTools->dtoToEntity(
            $contactDto,
            $contact
        );

        return $contact;
    }

    /**
     * @throws \DomainException
     */
    private function findCompanyContact(
        CompanyInterface $company,
        string $id
    ): ?ContactInterface {
        if ($id === '') {
            return null;
        }

        /** @var ContactInterface|null $contact */
        $contact = ctype_digit($id)
            ? $this->contactRepository->find((int) $id)
            : null;

        $belongsToCompany = $contact
            && $contact->getCompany()->getId() === $company->getId();

        // Same message for both cases so that contacts of other clients are not revealed
        if (!$belongsToCompany) {
            throw new \DomainException(
                sprintf('Contact %s not found', $id)
            );
        }

        return $contact;
    }

    /**
     * @param array<string, string> $columns
     * @throws \DomainException
     */
    private function applyPersonalData(
        ContactDto $contactDto,
        array $columns,
        bool $isNew
    ): void {
        $name = $columns['name'] ?? null;

        $isNameMissing = $name === null || $name === '';
        if ($isNew && $isNameMissing) {
            throw new \DomainException('Name is required to create a contact');
        }

        if ($name === '') {
            throw new \DomainException('Name cannot be empty');
        }

        if ($name !== null) {
            $contactDto->setName($name);
        }

        if (array_key_exists('lastname', $columns)) {
            $contactDto->setLastname(
                $this->nullIfEmpty($columns['lastname'])
            );
        }

        if (array_key_exists('email', $columns)) {
            $contactDto->setEmail(
                $this->nullIfEmpty($columns['email'])
            );
        }

        if (array_key_exists('otherPhone', $columns)) {
            $contactDto->setOtherPhone(
                $this->nullIfEmpty($columns['otherPhone'])
            );
        }
    }

    /**
     * @param array<string, string> $columns
     * @return array{0: string|null, 1: int|null} phone and country id
     * @throws \DomainException
     */
    private function resolvePhone(
        CompanyInterface $company,
        array $columns,
        string $phoneColumn,
        string $countryColumn,
        ?string $currentPhone,
        ?int $currentCountryId
    ): array {
        $phone = array_key_exists($phoneColumn, $columns)
            ? $this->nullIfEmpty($columns[$phoneColumn])
            : $currentPhone;

        $countryId = array_key_exists($countryColumn, $columns)
            ? $this->findCountryId($columns[$countryColumn])
            : $currentCountryId;

        $usesCompanyCountry = $phone !== null && $countryId === null;
        if ($usesCompanyCountry) {
            $countryId = $company->getCountry()->getId();
        }

        return [$phone, $countryId];
    }

    /**
     * @throws \DomainException
     */
    private function findCountryId(string $code): ?int
    {
        if ($code === '') {
            return null;
        }

        $country = $this->countryRepository->findOneByCode($code);
        if (!$country) {
            throw new \DomainException(
                sprintf('Country %s not found', $code)
            );
        }

        return $country->getId();
    }

    private function nullIfEmpty(string $value): ?string
    {
        return $value !== ''
            ? $value
            : null;
    }
}
