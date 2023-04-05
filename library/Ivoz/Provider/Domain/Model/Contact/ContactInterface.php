<?php

namespace Ivoz\Provider\Domain\Model\Contact;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Country\CountryInterface;

/**
* ContactInterface
*/
interface ContactInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array<string, mixed>
     */
    public function getChangeSet(): array;

    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId(): ?int;

    public static function createDto(string|int|null $id = null): ContactDto;

    /**
     * @internal use EntityTools instead
     * @param null|ContactInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?ContactDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param ContactDto $dto
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): ContactDto;

    public function getName(): string;

    public function getLastname(): ?string;

    public function getEmail(): ?string;

    public function getWorkPhone(): ?string;

    public function getWorkPhoneE164(): ?string;

    public function getMobilePhone(): ?string;

    public function getMobilePhoneE164(): ?string;

    public function getOtherPhone(): ?string;

    public function setUser(?UserInterface $user = null): static;

    public function getUser(): ?UserInterface;

    public function setCompany(CompanyInterface $company): static;

    public function getCompany(): CompanyInterface;

    public function getWorkPhoneCountry(): ?CountryInterface;

    public function getMobilePhoneCountry(): ?CountryInterface;
}
