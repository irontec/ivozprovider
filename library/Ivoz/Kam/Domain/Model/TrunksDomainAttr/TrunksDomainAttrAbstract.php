<?php

namespace Ivoz\Kam\Domain\Model\TrunksDomainAttr;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
 * TrunksDomainAttrAbstract
 * @codeCoverageIgnore
 */
abstract class TrunksDomainAttrAbstract
{
    /**
     * @var string
     */
    protected $did;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var integer
     */
    protected $type;

    /**
     * @var string
     */
    protected $value;

    /**
     * column: last_modified
     * @var \DateTime
     */
    protected $lastModified;


    use ChangelogTrait;

    /**
     * Constructor
     */
    protected function __construct(
        $did,
        $name,
        $type,
        $value,
        $lastModified
    ) {
        $this->setDid($did);
        $this->setName($name);
        $this->setType($type);
        $this->setValue($value);
        $this->setLastModified($lastModified);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "TrunksDomainAttr",
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
     * @return TrunksDomainAttrDto
     */
    public static function createDto($id = null)
    {
        return new TrunksDomainAttrDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param TrunksDomainAttrInterface|null $entity
     * @param int $depth
     * @return TrunksDomainAttrDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, TrunksDomainAttrInterface::class);

        if ($depth < 1) {
            return static::createDto($entity->getId());
        }

        if ($entity instanceof \Doctrine\ORM\Proxy\Proxy && !$entity->__isInitialized()) {
            return static::createDto($entity->getId());
        }

        /** @var TrunksDomainAttrDto $dto */
        $dto = $entity->toDto($depth-1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param TrunksDomainAttrDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, TrunksDomainAttrDto::class);

        $self = new static(
            $dto->getDid(),
            $dto->getName(),
            $dto->getType(),
            $dto->getValue(),
            $dto->getLastModified()
        );

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param TrunksDomainAttrDto $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, TrunksDomainAttrDto::class);

        $this
            ->setDid($dto->getDid())
            ->setName($dto->getName())
            ->setType($dto->getType())
            ->setValue($dto->getValue())
            ->setLastModified($dto->getLastModified());



        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return TrunksDomainAttrDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setDid(self::getDid())
            ->setName(self::getName())
            ->setType(self::getType())
            ->setValue(self::getValue())
            ->setLastModified(self::getLastModified());
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'did' => self::getDid(),
            'name' => self::getName(),
            'type' => self::getType(),
            'value' => self::getValue(),
            'last_modified' => self::getLastModified()
        ];
    }
    // @codeCoverageIgnoreStart

    /**
     * Set did
     *
     * @param string $did
     *
     * @return static
     */
    protected function setDid($did)
    {
        Assertion::notNull($did, 'did value "%s" is null, but non null value was expected.');
        Assertion::maxLength($did, 190, 'did value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->did = $did;

        return $this;
    }

    /**
     * Get did
     *
     * @return string
     */
    public function getDid(): string
    {
        return $this->did;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return static
     */
    protected function setName($name)
    {
        Assertion::notNull($name, 'name value "%s" is null, but non null value was expected.');
        Assertion::maxLength($name, 32, 'name value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set type
     *
     * @param integer $type
     *
     * @return static
     */
    protected function setType($type)
    {
        Assertion::notNull($type, 'type value "%s" is null, but non null value was expected.');
        Assertion::integerish($type, 'type value "%s" is not an integer or a number castable to integer.');
        Assertion::greaterOrEqualThan($type, 0, 'type provided "%s" is not greater or equal than "%s".');

        $this->type = (int) $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return integer
     */
    public function getType(): int
    {
        return $this->type;
    }

    /**
     * Set value
     *
     * @param string $value
     *
     * @return static
     */
    protected function setValue($value)
    {
        Assertion::notNull($value, 'value value "%s" is null, but non null value was expected.');
        Assertion::maxLength($value, 255, 'value value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * Set lastModified
     *
     * @param \DateTime $lastModified
     *
     * @return static
     */
    protected function setLastModified($lastModified)
    {
        Assertion::notNull($lastModified, 'lastModified value "%s" is null, but non null value was expected.');
        $lastModified = \Ivoz\Core\Domain\Model\Helper\DateTimeHelper::createOrFix(
            $lastModified,
            '1900-01-01 00:00:01'
        );

        if ($this->lastModified == $lastModified) {
            return $this;
        }

        $this->lastModified = $lastModified;

        return $this;
    }

    /**
     * Get lastModified
     *
     * @return \DateTime
     */
    public function getLastModified(): \DateTime
    {
        return clone $this->lastModified;
    }

    // @codeCoverageIgnoreEnd
}
