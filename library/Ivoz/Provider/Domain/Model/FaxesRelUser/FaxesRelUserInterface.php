<?php

namespace Ivoz\Provider\Domain\Model\FaxesRelUser;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Ivoz\Provider\Domain\Model\Fax\FaxInterface;

/**
* FaxesRelUserInterface
*/
interface FaxesRelUserInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array<string, mixed>
     */
    public function getChangeSet(): array;

    /**
     * Get id
     * @codeCoverageIgnore
     */
    public function getId(): ?int;

    /**
     * @param int | null $id
     */
    public static function createDto($id = null): FaxesRelUserDto;

    /**
     * @internal use EntityTools instead
     * @param null|FaxesRelUserInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?FaxesRelUserDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param FaxesRelUserDto $dto
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): FaxesRelUserDto;

    public function setUser(UserInterface $user): static;

    public function getUser(): UserInterface;

    public function setFax(?FaxInterface $fax = null): static;

    public function getFax(): ?FaxInterface;
}
