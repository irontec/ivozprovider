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
     * @param EntityInterface|null $entity
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

        return $entity->toDto($depth-1);
    }

    /**
     * Factory method
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDto(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto TrunksDomainAttrDto
         */
        Assertion::isInstanceOf($dto, TrunksDomainAttrDto::class);

        $self = new static(
            $dto->getDid(),
            $dto->getName(),
            $dto->getType(),
            $dto->getValue(),
            $dto->getLastModified());

        $self;

        $self->sanitizeValues();
        $self->initChangelog();

        return $self;
    }

    /**
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public function updateFromDto(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto TrunksDomainAttrDto
         */
        Assertion::isInstanceOf($dto, TrunksDomainAttrDto::class);

        $this
            ->setDid($dto->getDid())
            ->setName($dto->getName())
            ->setType($dto->getType())
            ->setValue($dto->getValue())
            ->setLastModified($dto->getLastModified());



        $this->sanitizeValues();
        return $this;
    }

    /**
     * @param int $depth
     * @return TrunksDomainAttrDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setDid($this->getDid())
            ->setName($this->getName())
            ->setType($this->getType())
            ->setValue($this->getValue())
            ->setLastModified($this->getLastModified());
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
     * @return self
     */
    public function setDid($did)
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
    public function getDid()
    {
        return $this->did;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return self
     */
    public function setName($name)
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set type
     *
     * @param integer $type
     *
     * @return self
     */
    public function setType($type)
    {
        Assertion::notNull($type, 'type value "%s" is null, but non null value was expected.');
        Assertion::integerish($type, 'type value "%s" is not an integer or a number castable to integer.');
        Assertion::greaterOrEqualThan($type, 0, 'type provided "%s" is not greater or equal than "%s".');

        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return integer
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set value
     *
     * @param string $value
     *
     * @return self
     */
    public function setValue($value)
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
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set lastModified
     *
     * @param \DateTime $lastModified
     *
     * @return self
     */
    public function setLastModified($lastModified)
    {
        Assertion::notNull($lastModified, 'lastModified value "%s" is null, but non null value was expected.');
        $lastModified = \Ivoz\Core\Domain\Model\Helper\DateTimeHelper::createOrFix(
            $lastModified,
            '1900-01-01 00:00:01'
        );

        $this->lastModified = $lastModified;

        return $this;
    }

    /**
     * Get lastModified
     *
     * @return \DateTime
     */
    public function getLastModified()
    {
        return $this->lastModified;
    }



    // @codeCoverageIgnoreEnd
}

