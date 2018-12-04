<?php

namespace Ivoz\Provider\Domain\Model\Destination;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
 * DestinationAbstract
 * @codeCoverageIgnore
 */
abstract class DestinationAbstract
{
    /**
     * @var string
     */
    protected $prefix;

    /**
     * @var Name
     */
    protected $name;

    /**
     * @var \Ivoz\Cgr\Domain\Model\TpDestination\TpDestinationInterface
     */
    protected $tpDestination;

    /**
     * @var \Ivoz\Provider\Domain\Model\Brand\BrandInterface
     */
    protected $brand;


    use ChangelogTrait;

    /**
     * Constructor
     */
    protected function __construct($prefix, Name $name)
    {
        $this->setPrefix($prefix);
        $this->setName($name);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "Destination",
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
     * @return DestinationDto
     */
    public static function createDto($id = null)
    {
        return new DestinationDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param EntityInterface|null $entity
     * @param int $depth
     * @return DestinationDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, DestinationInterface::class);

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
         * @var $dto DestinationDto
         */
        Assertion::isInstanceOf($dto, DestinationDto::class);

        $name = new Name(
            $dto->getNameEn(),
            $dto->getNameEs()
        );

        $self = new static(
            $dto->getPrefix(),
            $name
        );

        $self
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
         * @var $dto DestinationDto
         */
        Assertion::isInstanceOf($dto, DestinationDto::class);

        $name = new Name(
            $dto->getNameEn(),
            $dto->getNameEs()
        );

        $this
            ->setPrefix($dto->getPrefix())
            ->setName($name)
            ->setBrand($fkTransformer->transform($dto->getBrand()));



        $this->sanitizeValues();
        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return DestinationDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setPrefix(self::getPrefix())
            ->setNameEn(self::getName()->getEn())
            ->setNameEs(self::getName()->getEs())
            ->setBrand(\Ivoz\Provider\Domain\Model\Brand\Brand::entityToDto(self::getBrand(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'prefix' => self::getPrefix(),
            'nameEn' => self::getName()->getEn(),
            'nameEs' => self::getName()->getEs(),
            'brandId' => self::getBrand() ? self::getBrand()->getId() : null
        ];
    }
    // @codeCoverageIgnoreStart

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
        Assertion::maxLength($prefix, 24, 'prefix value "%s" is too long, it should have no more than %d characters, but has %d characters.');

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
     * Set tpDestination
     *
     * @param \Ivoz\Cgr\Domain\Model\TpDestination\TpDestinationInterface $tpDestination
     *
     * @return self
     */
    public function setTpDestination(\Ivoz\Cgr\Domain\Model\TpDestination\TpDestinationInterface $tpDestination = null)
    {
        $this->tpDestination = $tpDestination;

        return $this;
    }

    /**
     * Get tpDestination
     *
     * @return \Ivoz\Cgr\Domain\Model\TpDestination\TpDestinationInterface
     */
    public function getTpDestination()
    {
        return $this->tpDestination;
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

    /**
     * Set name
     *
     * @param \Ivoz\Provider\Domain\Model\Destination\Name $name
     *
     * @return self
     */
    public function setName(Name $name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get name
     *
     * @return \Ivoz\Provider\Domain\Model\Destination\Name
     */
    public function getName()
    {
        return $this->name;
    }
    // @codeCoverageIgnoreEnd
}
