<?php

namespace Ivoz\Provider\Domain\Model\PickUpGroup;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\PickUpRelUser\PickUpRelUserInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;

/**
* PickUpGroupInterface
*/
interface PickUpGroupInterface extends LoggableEntityInterface
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

    public static function createDto(string|int|null $id = null): PickUpGroupDto;

    /**
     * @internal use EntityTools instead
     * @param null|PickUpGroupInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?PickUpGroupDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): PickUpGroupDto;

    public function getName(): string;

    public function getCompany(): CompanyInterface;

    public function isInitialized(): bool;

    public function addRelUser(PickUpRelUserInterface $relUser): PickUpGroupInterface;

    public function removeRelUser(PickUpRelUserInterface $relUser): PickUpGroupInterface;

    public function replaceRelUsers(ArrayCollection $relUsers): PickUpGroupInterface;

    public function getRelUsers(?Criteria $criteria = null): array;
}
