<?php

declare(strict_types=1);

namespace Ivoz\Kam\Domain\Model\UsersHtable;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;

/**
* UsersHtableAbstract
* @codeCoverageIgnore
*/
abstract class UsersHtableAbstract
{
    use ChangelogTrait;

    /**
     * @var string
     * column: key_name
     */
    protected $keyName = '';

    /**
     * @var int
     * column: key_type
     */
    protected $keyType = 0;

    /**
     * @var int
     * column: value_type
     */
    protected $valueType = 0;

    /**
     * @var string
     * column: key_value
     */
    protected $keyValue = '';

    /**
     * @var int
     */
    protected $expires = 0;

    /**
     * Constructor
     */
    protected function __construct(
        string $keyName,
        int $keyType,
        int $valueType,
        string $keyValue,
        int $expires
    ) {
        $this->setKeyName($keyName);
        $this->setKeyType($keyType);
        $this->setValueType($valueType);
        $this->setKeyValue($keyValue);
        $this->setExpires($expires);
    }

    abstract public function getId(): null|string|int;

    public function __toString(): string
    {
        return sprintf(
            "%s#%s",
            "UsersHtable",
            (string) $this->getId()
        );
    }

    /**
     * @throws \Exception
     */
    protected function sanitizeValues(): void
    {
    }

    public static function createDto(string|int|null $id = null): UsersHtableDto
    {
        return new UsersHtableDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|UsersHtableInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?UsersHtableDto
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, UsersHtableInterface::class);

        if ($depth < 1) {
            return static::createDto($entity->getId());
        }

        if ($entity instanceof \Doctrine\ORM\Proxy\Proxy && !$entity->__isInitialized()) {
            return static::createDto($entity->getId());
        }

        $dto = $entity->toDto($depth - 1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param UsersHtableDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, UsersHtableDto::class);
        $keyName = $dto->getKeyName();
        Assertion::notNull($keyName, 'getKeyName value is null, but non null value was expected.');
        $keyType = $dto->getKeyType();
        Assertion::notNull($keyType, 'getKeyType value is null, but non null value was expected.');
        $valueType = $dto->getValueType();
        Assertion::notNull($valueType, 'getValueType value is null, but non null value was expected.');
        $keyValue = $dto->getKeyValue();
        Assertion::notNull($keyValue, 'getKeyValue value is null, but non null value was expected.');
        $expires = $dto->getExpires();
        Assertion::notNull($expires, 'getExpires value is null, but non null value was expected.');

        $self = new static(
            $keyName,
            $keyType,
            $valueType,
            $keyValue,
            $expires
        );

        ;

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param UsersHtableDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, UsersHtableDto::class);

        $keyName = $dto->getKeyName();
        Assertion::notNull($keyName, 'getKeyName value is null, but non null value was expected.');
        $keyType = $dto->getKeyType();
        Assertion::notNull($keyType, 'getKeyType value is null, but non null value was expected.');
        $valueType = $dto->getValueType();
        Assertion::notNull($valueType, 'getValueType value is null, but non null value was expected.');
        $keyValue = $dto->getKeyValue();
        Assertion::notNull($keyValue, 'getKeyValue value is null, but non null value was expected.');
        $expires = $dto->getExpires();
        Assertion::notNull($expires, 'getExpires value is null, but non null value was expected.');

        $this
            ->setKeyName($keyName)
            ->setKeyType($keyType)
            ->setValueType($valueType)
            ->setKeyValue($keyValue)
            ->setExpires($expires);

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): UsersHtableDto
    {
        return self::createDto()
            ->setKeyName(self::getKeyName())
            ->setKeyType(self::getKeyType())
            ->setValueType(self::getValueType())
            ->setKeyValue(self::getKeyValue())
            ->setExpires(self::getExpires());
    }

    /**
     * @return array<string, mixed>
     */
    protected function __toArray(): array
    {
        return [
            'key_name' => self::getKeyName(),
            'key_type' => self::getKeyType(),
            'value_type' => self::getValueType(),
            'key_value' => self::getKeyValue(),
            'expires' => self::getExpires()
        ];
    }

    protected function setKeyName(string $keyName): static
    {
        Assertion::maxLength($keyName, 64, 'keyName value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->keyName = $keyName;

        return $this;
    }

    public function getKeyName(): string
    {
        return $this->keyName;
    }

    protected function setKeyType(int $keyType): static
    {
        $this->keyType = $keyType;

        return $this;
    }

    public function getKeyType(): int
    {
        return $this->keyType;
    }

    protected function setValueType(int $valueType): static
    {
        $this->valueType = $valueType;

        return $this;
    }

    public function getValueType(): int
    {
        return $this->valueType;
    }

    protected function setKeyValue(string $keyValue): static
    {
        Assertion::maxLength($keyValue, 128, 'keyValue value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->keyValue = $keyValue;

        return $this;
    }

    public function getKeyValue(): string
    {
        return $this->keyValue;
    }

    protected function setExpires(int $expires): static
    {
        $this->expires = $expires;

        return $this;
    }

    public function getExpires(): int
    {
        return $this->expires;
    }
}
