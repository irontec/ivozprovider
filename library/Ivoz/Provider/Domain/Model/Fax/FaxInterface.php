<?php

namespace Ivoz\Provider\Domain\Model\Fax;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Provider\Domain\Model\Ddi\DdiInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\FaxesRelUser\FaxesRelUserInterface;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;

/**
* FaxInterface
*/
interface FaxInterface extends LoggableEntityInterface
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

    public function setSendByEmail(bool $sendByEmail): static;

    /**
     * @return DdiInterface|null
     */
    public function getOutgoingDdi(): ?DdiInterface;

    /**
     * @param int | null $id
     */
    public static function createDto($id = null): FaxDto;

    /**
     * @internal use EntityTools instead
     * @param null|FaxInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?FaxDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param FaxDto $dto
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): FaxDto;

    public function getName(): string;

    public function getEmail(): ?string;

    public function getSendByEmail(): bool;

    public function getCompany(): CompanyInterface;

    public function addFaxesRelUser(FaxesRelUserInterface $faxesRelUser): FaxInterface;

    public function removeFaxesRelUser(FaxesRelUserInterface $faxesRelUser): FaxInterface;

    /**
     * @param Collection<array-key, FaxesRelUserInterface> $faxesRelUsers
     */
    public function replaceFaxesRelUsers(Collection $faxesRelUsers): FaxInterface;

    /**
     * @return array<array-key, FaxesRelUserInterface>
     */
    public function getFaxesRelUsers(?Criteria $criteria = null): array;
}
