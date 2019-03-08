<?php

namespace Ivoz\Provider\Domain\Model\InvoiceNumberSequence;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
 * InvoiceNumberSequenceAbstract
 * @codeCoverageIgnore
 */
abstract class InvoiceNumberSequenceAbstract
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $prefix = '';

    /**
     * @var integer
     */
    protected $sequenceLength;

    /**
     * @var integer
     */
    protected $increment;

    /**
     * @var string | null
     */
    protected $latestValue = '';

    /**
     * @var integer
     */
    protected $iteration = 0;

    /**
     * @var integer
     */
    protected $version;

    /**
     * @var \Ivoz\Provider\Domain\Model\Brand\BrandInterface
     */
    protected $brand;


    use ChangelogTrait;

    /**
     * Constructor
     */
    protected function __construct(
        $name,
        $prefix,
        $sequenceLength,
        $increment,
        $iteration,
        $version
    ) {
        $this->setName($name);
        $this->setPrefix($prefix);
        $this->setSequenceLength($sequenceLength);
        $this->setIncrement($increment);
        $this->setIteration($iteration);
        $this->setVersion($version);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "InvoiceNumberSequence",
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
     * @return InvoiceNumberSequenceDto
     */
    public static function createDto($id = null)
    {
        return new InvoiceNumberSequenceDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param EntityInterface|null $entity
     * @param int $depth
     * @return InvoiceNumberSequenceDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, InvoiceNumberSequenceInterface::class);

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
    public static function fromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        /**
         * @var $dto InvoiceNumberSequenceDto
         */
        Assertion::isInstanceOf($dto, InvoiceNumberSequenceDto::class);

        $self = new static(
            $dto->getName(),
            $dto->getPrefix(),
            $dto->getSequenceLength(),
            $dto->getIncrement(),
            $dto->getIteration(),
            $dto->getVersion()
        );

        $self
            ->setLatestValue($dto->getLatestValue())
            ->setBrand($fkTransformer->transform($dto->getBrand()))
        ;

        $self->sanitizeValues();
        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        /**
         * @var $dto InvoiceNumberSequenceDto
         */
        Assertion::isInstanceOf($dto, InvoiceNumberSequenceDto::class);

        $this
            ->setName($dto->getName())
            ->setPrefix($dto->getPrefix())
            ->setSequenceLength($dto->getSequenceLength())
            ->setIncrement($dto->getIncrement())
            ->setLatestValue($dto->getLatestValue())
            ->setIteration($dto->getIteration())
            ->setVersion($dto->getVersion())
            ->setBrand($fkTransformer->transform($dto->getBrand()));



        $this->sanitizeValues();
        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return InvoiceNumberSequenceDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setName(self::getName())
            ->setPrefix(self::getPrefix())
            ->setSequenceLength(self::getSequenceLength())
            ->setIncrement(self::getIncrement())
            ->setLatestValue(self::getLatestValue())
            ->setIteration(self::getIteration())
            ->setVersion(self::getVersion())
            ->setBrand(\Ivoz\Provider\Domain\Model\Brand\Brand::entityToDto(self::getBrand(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'name' => self::getName(),
            'prefix' => self::getPrefix(),
            'sequenceLength' => self::getSequenceLength(),
            'increment' => self::getIncrement(),
            'latestValue' => self::getLatestValue(),
            'iteration' => self::getIteration(),
            'version' => self::getVersion(),
            'brandId' => self::getBrand() ? self::getBrand()->getId() : null
        ];
    }
    // @codeCoverageIgnoreStart

    /**
     * Set name
     *
     * @param string $name
     *
     * @return self
     */
    protected function setName($name)
    {
        Assertion::notNull($name, 'name value "%s" is null, but non null value was expected.');
        Assertion::maxLength($name, 40, 'name value "%s" is too long, it should have no more than %d characters, but has %d characters.');

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
     * Set prefix
     *
     * @param string $prefix
     *
     * @return self
     */
    protected function setPrefix($prefix)
    {
        Assertion::notNull($prefix, 'prefix value "%s" is null, but non null value was expected.');
        Assertion::maxLength($prefix, 20, 'prefix value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->prefix = $prefix;

        return $this;
    }

    /**
     * Get prefix
     *
     * @return string
     */
    public function getPrefix()
    {
        return $this->prefix;
    }

    /**
     * Set sequenceLength
     *
     * @param integer $sequenceLength
     *
     * @return self
     */
    protected function setSequenceLength($sequenceLength)
    {
        Assertion::notNull($sequenceLength, 'sequenceLength value "%s" is null, but non null value was expected.');
        Assertion::integerish($sequenceLength, 'sequenceLength value "%s" is not an integer or a number castable to integer.');
        Assertion::greaterOrEqualThan($sequenceLength, 0, 'sequenceLength provided "%s" is not greater or equal than "%s".');

        $this->sequenceLength = (int) $sequenceLength;

        return $this;
    }

    /**
     * Get sequenceLength
     *
     * @return integer
     */
    public function getSequenceLength()
    {
        return $this->sequenceLength;
    }

    /**
     * Set increment
     *
     * @param integer $increment
     *
     * @return self
     */
    protected function setIncrement($increment)
    {
        Assertion::notNull($increment, 'increment value "%s" is null, but non null value was expected.');
        Assertion::integerish($increment, 'increment value "%s" is not an integer or a number castable to integer.');
        Assertion::greaterOrEqualThan($increment, 0, 'increment provided "%s" is not greater or equal than "%s".');

        $this->increment = (int) $increment;

        return $this;
    }

    /**
     * Get increment
     *
     * @return integer
     */
    public function getIncrement()
    {
        return $this->increment;
    }

    /**
     * Set latestValue
     *
     * @param string $latestValue
     *
     * @return self
     */
    protected function setLatestValue($latestValue = null)
    {
        if (!is_null($latestValue)) {
        }

        $this->latestValue = $latestValue;

        return $this;
    }

    /**
     * Get latestValue
     *
     * @return string | null
     */
    public function getLatestValue()
    {
        return $this->latestValue;
    }

    /**
     * Set iteration
     *
     * @param integer $iteration
     *
     * @return self
     */
    protected function setIteration($iteration)
    {
        Assertion::notNull($iteration, 'iteration value "%s" is null, but non null value was expected.');
        Assertion::integerish($iteration, 'iteration value "%s" is not an integer or a number castable to integer.');
        Assertion::greaterOrEqualThan($iteration, 0, 'iteration provided "%s" is not greater or equal than "%s".');

        $this->iteration = (int) $iteration;

        return $this;
    }

    /**
     * Get iteration
     *
     * @return integer
     */
    public function getIteration()
    {
        return $this->iteration;
    }

    /**
     * Set version
     *
     * @param integer $version
     *
     * @return self
     */
    protected function setVersion($version)
    {
        Assertion::notNull($version, 'version value "%s" is null, but non null value was expected.');
        Assertion::integerish($version, 'version value "%s" is not an integer or a number castable to integer.');

        $this->version = (int) $version;

        return $this;
    }

    /**
     * Get version
     *
     * @return integer
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Set brand
     *
     * @param \Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand
     *
     * @return self
     */
    public function setBrand(\Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand)
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * Get brand
     *
     * @return \Ivoz\Provider\Domain\Model\Brand\BrandInterface
     */
    public function getBrand()
    {
        return $this->brand;
    }

    // @codeCoverageIgnoreEnd
}
