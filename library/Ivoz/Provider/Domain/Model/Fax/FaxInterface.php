<?php

namespace Ivoz\Provider\Domain\Model\Fax;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Provider\Domain\Model\Ddi\DdiInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;

/**
* FaxInterface
*/
interface FaxInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
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

    public static function createDto(string|int|null $id = null): FaxDto;

    /**
     * @internal use EntityTools instead
     * @param null|FaxInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?FaxDto;

    /**
     * Factory method
     * @internal use EntityTools instead
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

    public function isInitialized(): bool;
}
