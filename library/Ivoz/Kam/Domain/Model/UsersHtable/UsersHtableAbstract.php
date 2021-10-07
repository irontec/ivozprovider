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
     * column: key_name
     * @var string
     */
    protected $keyName = '';

    /**
     * column: key_type
     * @var int
     */
    protected $keyType = 0;

    /**
     * column: value_type
     * @var int
     */
    protected $valueType = 0;

    /**
     * column: key_value
     * @var string
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
        $keyName,
        $keyType,
        $valueType,
        $keyValue,
        $expires
    ) {
        $this->setKeyName($keyName);
        $this->setKeyType($keyType);
        $this->setValueType($valueType);
        $this->setKeyValue($keyValue);
        $this->setExpires($expires);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "UsersHtable",
            $this->getId()
        );
    }

    /**
     * @return void
     * @throws \Exception
     */
    protected function sanitizeValues()
    {
    }

    /**
     * @param mixed $id
     * @return UsersHtableDto
     */
    public static function createDto($id = null)
    {
        return new UsersHtableDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param UsersHtableInterface|null $entity
     * @param int $depth
     * @return UsersHtableDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
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

        /** @var UsersHtableDto $dto */
        $dto = $entity->toDto($depth - 1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param UsersHtableDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, UsersHtableDto::class);

        $self = new static(
            $dto->getKeyName(),
            $dto->getKeyType(),
            $dto->getValueType(),
            $dto->getKeyValue(),
            $dto->getExpires()
        );

        ;

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param UsersHtableDto $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, UsersHtableDto::class);

        $this
            ->setKeyName($dto->getKeyName())
            ->setKeyType($dto->getKeyType())
            ->setValueType($dto->getValueType())
            ->setKeyValue($dto->getKeyValue())
            ->setExpires($dto->getExpires());

        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return UsersHtableDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setKeyName(self::getKeyName())
            ->setKeyType(self::getKeyType())
            ->setValueType(self::getValueType())
            ->setKeyValue(self::getKeyValue())
            ->setExpires(self::getExpires());
    }

    /**
     * @return array
     */
    protected function __toArray()
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
