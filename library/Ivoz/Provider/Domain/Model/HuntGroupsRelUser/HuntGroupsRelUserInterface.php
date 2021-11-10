<?php

namespace Ivoz\Provider\Domain\Model\HuntGroupsRelUser;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\HuntGroup\HuntGroupInterface;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Ivoz\Provider\Domain\Model\Country\CountryInterface;

/**
* HuntGroupsRelUserInterface
*/
interface HuntGroupsRelUserInterface extends LoggableEntityInterface
{
    public const ROUTETYPE_NUMBER = 'number';

    public const ROUTETYPE_USER = 'user';

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

    /**
     * Get the numberValue in E.164 format when routing to 'number'
     *
     * @return string
     */
    public function getNumberValueE164();

    public static function createDto(string|int|null $id = null): HuntGroupsRelUserDto;

    /**
     * @internal use EntityTools instead
     * @param null|HuntGroupsRelUserInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?HuntGroupsRelUserDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): HuntGroupsRelUserDto;

    public function getTimeoutTime(): ?int;

    public function getPriority(): ?int;

    public function getRouteType(): string;

    public function getNumberValue(): ?string;

    public function setHuntGroup(?HuntGroupInterface $huntGroup = null): static;

    public function getHuntGroup(): ?HuntGroupInterface;

    public function getUser(): ?UserInterface;

    public function getNumberCountry(): ?CountryInterface;

    public function isInitialized(): bool;

    /**
     * @param string $prefix
     * @return null|string
     */
    public function getTarget(string $prefix = '');
}
