<?php

namespace Ivoz\Kam\Domain\Model\TrunksHtable;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
 * TrunksHtableAbstract
 * @codeCoverageIgnore
 */
abstract class TrunksHtableAbstract
{
    /**
     * column: key_name
     * @var string
     */
    protected $keyName = '';

    /**
     * column: key_type
     * @var integer
     */
    protected $keyType = '0';

    /**
     * column: value_type
     * @var integer
     */
    protected $valueType = '0';

    /**
     * column: key_value
     * @var string
     */
    protected $keyValue = '';

    /**
     * @var integer
     */
    protected $expires = '0';


    use ChangelogTrait;

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
            "TrunksHtable",
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
     * @param null $id
     * @return TrunksHtableDto
     */
    public static function createDto($id = null)
    {
        return new TrunksHtableDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param EntityInterface|null $entity
     * @param int $depth
     * @return TrunksHtableDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, TrunksHtableInterface::class);

        if ($depth < 1) {
            return static::createDto($entity->getId());
        }

        if ($entity instanceof \Doctrine\ORM\Proxy\Proxy && !$entity->__isInitialized()) {
            return static::createDto($entity->getId());
        }

        return $entity->toDto($depth-1);
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDto(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto TrunksHtableDto
         */
        Assertion::isInstanceOf($dto, TrunksHtableDto::class);

        $self = new static(
            $dto->getKeyName(),
            $dto->getKeyType(),
            $dto->getValueType(),
            $dto->getKeyValue(),
            $dto->getExpires()
        );

        $self->sanitizeValues();
        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public function updateFromDto(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto TrunksHtableDto
         */
        Assertion::isInstanceOf($dto, TrunksHtableDto::class);

        $this
            ->setKeyName($dto->getKeyName())
            ->setKeyType($dto->getKeyType())
            ->setValueType($dto->getValueType())
            ->setKeyValue($dto->getKeyValue())
            ->setExpires($dto->getExpires());



        $this->sanitizeValues();
        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return TrunksHtableDto
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
    // @codeCoverageIgnoreStart

    /**
     * @deprecated
     * Set keyName
     *
     * @param string $keyName
     *
     * @return self
     */
    public function setKeyName($keyName)
    {
        Assertion::notNull($keyName, 'keyName value "%s" is null, but non null value was expected.');
        Assertion::maxLength($keyName, 64, 'keyName value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->keyName = $keyName;

        return $this;
    }

    /**
     * Get keyName
     *
     * @return string
     */
    public function getKeyName()
    {
        return $this->keyName;
    }

    /**
     * @deprecated
     * Set keyType
     *
     * @param integer $keyType
     *
     * @return self
     */
    public function setKeyType($keyType)
    {
        Assertion::notNull($keyType, 'keyType value "%s" is null, but non null value was expected.');
        Assertion::integerish($keyType, 'keyType value "%s" is not an integer or a number castable to integer.');

        $this->keyType = $keyType;

        return $this;
    }

    /**
     * Get keyType
     *
     * @return integer
     */
    public function getKeyType()
    {
        return $this->keyType;
    }

    /**
     * @deprecated
     * Set valueType
     *
     * @param integer $valueType
     *
     * @return self
     */
    public function setValueType($valueType)
    {
        Assertion::notNull($valueType, 'valueType value "%s" is null, but non null value was expected.');
        Assertion::integerish($valueType, 'valueType value "%s" is not an integer or a number castable to integer.');

        $this->valueType = $valueType;

        return $this;
    }

    /**
     * Get valueType
     *
     * @return integer
     */
    public function getValueType()
    {
        return $this->valueType;
    }

    /**
     * @deprecated
     * Set keyValue
     *
     * @param string $keyValue
     *
     * @return self
     */
    public function setKeyValue($keyValue)
    {
        Assertion::notNull($keyValue, 'keyValue value "%s" is null, but non null value was expected.');
        Assertion::maxLength($keyValue, 128, 'keyValue value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->keyValue = $keyValue;

        return $this;
    }

    /**
     * Get keyValue
     *
     * @return string
     */
    public function getKeyValue()
    {
        return $this->keyValue;
    }

    /**
     * @deprecated
     * Set expires
     *
     * @param integer $expires
     *
     * @return self
     */
    public function setExpires($expires)
    {
        Assertion::notNull($expires, 'expires value "%s" is null, but non null value was expected.');
        Assertion::integerish($expires, 'expires value "%s" is not an integer or a number castable to integer.');

        $this->expires = $expires;

        return $this;
    }

    /**
     * Get expires
     *
     * @return integer
     */
    public function getExpires()
    {
        return $this->expires;
    }

    // @codeCoverageIgnoreEnd
}
