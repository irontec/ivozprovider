<?php

namespace Ivoz\Provider\Domain\Model\Location;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;

/**
* LocationInterface
*/
interface LocationInterface extends LoggableEntityInterface
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

    public static function createDto(string|int|null $id = null): LocationDto;

    /**
     * @internal use EntityTools instead
     * @param null|LocationInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?LocationDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param LocationDto $dto
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): LocationDto;

    public function getName(): string;

    public function getDescription(): ?string;

    public function getCompany(): CompanyInterface;

    public function addUser(UserInterface $user): LocationInterface;

    public function removeUser(UserInterface $user): LocationInterface;

    /**
     * @param Collection<array-key, UserInterface> $users
     */
    public function replaceUsers(Collection $users): LocationInterface;

    /**
     * @return array<array-key, UserInterface>
     */
    public function getUsers(?Criteria $criteria = null): array;
}
