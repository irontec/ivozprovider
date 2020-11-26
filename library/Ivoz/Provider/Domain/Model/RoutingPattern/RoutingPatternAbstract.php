<?php
declare(strict_types = 1);

namespace Ivoz\Provider\Domain\Model\RoutingPattern;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use \Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\RoutingPattern\Name;
use Ivoz\Provider\Domain\Model\RoutingPattern\Description;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Brand\Brand;

/**
* RoutingPatternAbstract
* @codeCoverageIgnore
*/
abstract class RoutingPatternAbstract
{
    use ChangelogTrait;

    /**
     * @var string
     */
    protected $prefix;

    /**
     * @var Name | null
     */
    protected $name;

    /**
     * @var Description | null
     */
    protected $description;

    /**
     * @var BrandInterface
     */
    protected $brand;

    /**
     * Constructor
     */
    protected function __construct(
        $prefix,
        Name $name,
        Description $description
    ) {
        $this->setPrefix($prefix);
        $this->setName($name);
        $this->setDescription($description);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "RoutingPattern",
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
     * @return RoutingPatternDto
     */
    public static function createDto($id = null)
    {
        return new RoutingPatternDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param RoutingPatternInterface|null $entity
     * @param int $depth
     * @return RoutingPatternDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, RoutingPatternInterface::class);

        if ($depth < 1) {
            return static::createDto($entity->getId());
        }

        if ($entity instanceof \Doctrine\ORM\Proxy\Proxy && !$entity->__isInitialized()) {
            return static::createDto($entity->getId());
        }

        /** @var RoutingPatternDto $dto */
        $dto = $entity->toDto($depth-1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param RoutingPatternDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, RoutingPatternDto::class);

        $name = new Name(
            $dto->getNameEn(),
            $dto->getNameEs(),
            $dto->getNameCa(),
            $dto->getNameIt()
        );

        $description = new Description(
            $dto->getDescriptionEn(),
            $dto->getDescriptionEs(),
            $dto->getDescriptionCa(),
            $dto->getDescriptionIt()
        );

        $self = new static(
            $dto->getPrefix(),
            $name,
            $description
        );

        $self
            ->setBrand($fkTransformer->transform($dto->getBrand()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param RoutingPatternDto $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, RoutingPatternDto::class);

        $name = new Name(
            $dto->getNameEn(),
            $dto->getNameEs(),
            $dto->getNameCa(),
            $dto->getNameIt()
        );

        $description = new Description(
            $dto->getDescriptionEn(),
            $dto->getDescriptionEs(),
            $dto->getDescriptionCa(),
            $dto->getDescriptionIt()
        );

        $this
            ->setPrefix($dto->getPrefix())
            ->setName($name)
            ->setDescription($description)
            ->setBrand($fkTransformer->transform($dto->getBrand()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return RoutingPatternDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setPrefix(self::getPrefix())
            ->setNameEn(self::getName()->getEn())
            ->setNameEs(self::getName()->getEs())
            ->setNameCa(self::getName()->getCa())
            ->setNameIt(self::getName()->getIt())
            ->setDescriptionEn(self::getDescription()->getEn())
            ->setDescriptionEs(self::getDescription()->getEs())
            ->setDescriptionCa(self::getDescription()->getCa())
            ->setDescriptionIt(self::getDescription()->getIt())
            ->setBrand(Brand::entityToDto(self::getBrand(), $depth));
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
            'nameCa' => self::getName()->getCa(),
            'nameIt' => self::getName()->getIt(),
            'descriptionEn' => self::getDescription()->getEn(),
            'descriptionEs' => self::getDescription()->getEs(),
            'descriptionCa' => self::getDescription()->getCa(),
            'descriptionIt' => self::getDescription()->getIt(),
            'brandId' => self::getBrand()->getId()
        ];
    }

    /**
     * Set prefix
     *
     * @param string $prefix
     *
     * @return static
     */
    protected function setPrefix(string $prefix): RoutingPatternInterface
    {
        Assertion::maxLength($prefix, 80, 'prefix value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->prefix = $prefix;

        return $this;
    }

    /**
     * Get prefix
     *
     * @return string
     */
    public function getPrefix(): string
    {
        return $this->prefix;
    }

    /**
     * Get name
     *
     * @return Name
     */
    public function getName(): Name
    {
        return $this->name;
    }

    /**
     * Set name
     *
     * @return static
     */
    protected function setName(Name $name): RoutingPatternInterface
    {
        $isEqual = $this->name && $this->name->equals($name);
        if ($isEqual) {
            return $this;
        }

        $this->name = $name;
        return $this;
    }

    /**
     * Get description
     *
     * @return Description
     */
    public function getDescription(): Description
    {
        return $this->description;
    }

    /**
     * Set description
     *
     * @return static
     */
    protected function setDescription(Description $description): RoutingPatternInterface
    {
        $isEqual = $this->description && $this->description->equals($description);
        if ($isEqual) {
            return $this;
        }

        $this->description = $description;
        return $this;
    }

    /**
     * Set brand
     *
     * @param BrandInterface
     *
     * @return static
     */
    protected function setBrand(BrandInterface $brand): RoutingPatternInterface
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * Get brand
     *
     * @return BrandInterface
     */
    public function getBrand(): BrandInterface
    {
        return $this->brand;
    }

}
