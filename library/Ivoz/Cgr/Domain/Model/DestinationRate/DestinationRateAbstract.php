<?php

namespace Ivoz\Cgr\Domain\Model\DestinationRate;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
 * DestinationRateAbstract
 * @codeCoverageIgnore
 */
abstract class DestinationRateAbstract
{
    /**
     * @var string
     */
    protected $tag;

    /**
     * @var Name
     */
    protected $name;

    /**
     * @var Description
     */
    protected $description;

    /**
     * @var \Ivoz\Provider\Domain\Model\Brand\BrandInterface
     */
    protected $brand;


    use ChangelogTrait;

    /**
     * Constructor
     */
    protected function __construct(Name $name, Description $description)
    {
        $this->setName($name);
        $this->setDescription($description);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf("%s#%s",
            "DestinationRate",
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
     * @return DestinationRateDto
     */
    public static function createDto($id = null)
    {
        return new DestinationRateDto($id);
    }

    /**
     * @param EntityInterface|null $entity
     * @param int $depth
     * @return DestinationRateDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, DestinationRateInterface::class);

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
         * @var $dto DestinationRateDto
         */
        Assertion::isInstanceOf($dto, DestinationRateDto::class);

        $name = new Name(
            $dto->getNameEn(),
            $dto->getNameEs()
        );

        $description = new Description(
            $dto->getDescriptionEn(),
            $dto->getDescriptionEs()
        );

        $self = new static(
            $name,
            $description
        );

        $self
            ->setTag($dto->getTag())
            ->setBrand($dto->getBrand())
        ;

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
         * @var $dto DestinationRateDto
         */
        Assertion::isInstanceOf($dto, DestinationRateDto::class);

        $name = new Name(
            $dto->getNameEn(),
            $dto->getNameEs()
        );

        $description = new Description(
            $dto->getDescriptionEn(),
            $dto->getDescriptionEs()
        );

        $this
            ->setTag($dto->getTag())
            ->setName($name)
            ->setDescription($description)
            ->setBrand($dto->getBrand());



        $this->sanitizeValues();
        return $this;
    }

    /**
     * @param int $depth
     * @return DestinationRateDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setTag($this->getTag())
            ->setNameEn($this->getName()->getEn())
            ->setNameEs($this->getName()->getEs())
            ->setDescriptionEn($this->getDescription()->getEn())
            ->setDescriptionEs($this->getDescription()->getEs())
            ->setBrand(\Ivoz\Provider\Domain\Model\Brand\Brand::entityToDto($this->getBrand(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'tag' => self::getTag(),
            'nameEn' => self::getName()->getEn(),
            'nameEs' => self::getName()->getEs(),
            'descriptionEn' => self::getDescription()->getEn(),
            'descriptionEs' => self::getDescription()->getEs(),
            'brandId' => self::getBrand() ? self::getBrand()->getId() : null
        ];
    }


    // @codeCoverageIgnoreStart

    /**
     * Set tag
     *
     * @param string $tag
     *
     * @return self
     */
    public function setTag($tag = null)
    {
        if (!is_null($tag)) {
            Assertion::maxLength($tag, 64, 'tag value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->tag = $tag;

        return $this;
    }

    /**
     * Get tag
     *
     * @return string
     */
    public function getTag()
    {
        return $this->tag;
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
     * @param \Ivoz\Cgr\Domain\Model\DestinationRate\Name $name
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
     * @return \Ivoz\Cgr\Domain\Model\DestinationRate\Name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param \Ivoz\Cgr\Domain\Model\DestinationRate\Description $description
     *
     * @return self
     */
    public function setDescription(Description $description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return \Ivoz\Cgr\Domain\Model\DestinationRate\Description
     */
    public function getDescription()
    {
        return $this->description;
    }

    // @codeCoverageIgnoreEnd
}

