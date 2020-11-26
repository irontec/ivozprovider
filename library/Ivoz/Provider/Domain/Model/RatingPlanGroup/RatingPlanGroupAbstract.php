<?php
declare(strict_types = 1);

namespace Ivoz\Provider\Domain\Model\RatingPlanGroup;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use \Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\RatingPlanGroup\Name;
use Ivoz\Provider\Domain\Model\RatingPlanGroup\Description;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Currency\CurrencyInterface;
use Ivoz\Provider\Domain\Model\Brand\Brand;
use Ivoz\Provider\Domain\Model\Currency\Currency;

/**
* RatingPlanGroupAbstract
* @codeCoverageIgnore
*/
abstract class RatingPlanGroupAbstract
{
    use ChangelogTrait;

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
     * @var CurrencyInterface
     */
    protected $currency;

    /**
     * Constructor
     */
    protected function __construct(
        Name $name,
        Description $description
    ) {
        $this->setName($name);
        $this->setDescription($description);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "RatingPlanGroup",
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
     * @return RatingPlanGroupDto
     */
    public static function createDto($id = null)
    {
        return new RatingPlanGroupDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param RatingPlanGroupInterface|null $entity
     * @param int $depth
     * @return RatingPlanGroupDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, RatingPlanGroupInterface::class);

        if ($depth < 1) {
            return static::createDto($entity->getId());
        }

        if ($entity instanceof \Doctrine\ORM\Proxy\Proxy && !$entity->__isInitialized()) {
            return static::createDto($entity->getId());
        }

        /** @var RatingPlanGroupDto $dto */
        $dto = $entity->toDto($depth-1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param RatingPlanGroupDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, RatingPlanGroupDto::class);

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
            $name,
            $description
        );

        $self
            ->setBrand($fkTransformer->transform($dto->getBrand()))
            ->setCurrency($fkTransformer->transform($dto->getCurrency()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param RatingPlanGroupDto $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, RatingPlanGroupDto::class);

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
            ->setName($name)
            ->setDescription($description)
            ->setBrand($fkTransformer->transform($dto->getBrand()))
            ->setCurrency($fkTransformer->transform($dto->getCurrency()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return RatingPlanGroupDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setNameEn(self::getName()->getEn())
            ->setNameEs(self::getName()->getEs())
            ->setNameCa(self::getName()->getCa())
            ->setNameIt(self::getName()->getIt())
            ->setDescriptionEn(self::getDescription()->getEn())
            ->setDescriptionEs(self::getDescription()->getEs())
            ->setDescriptionCa(self::getDescription()->getCa())
            ->setDescriptionIt(self::getDescription()->getIt())
            ->setBrand(Brand::entityToDto(self::getBrand(), $depth))
            ->setCurrency(Currency::entityToDto(self::getCurrency(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'nameEn' => self::getName()->getEn(),
            'nameEs' => self::getName()->getEs(),
            'nameCa' => self::getName()->getCa(),
            'nameIt' => self::getName()->getIt(),
            'descriptionEn' => self::getDescription()->getEn(),
            'descriptionEs' => self::getDescription()->getEs(),
            'descriptionCa' => self::getDescription()->getCa(),
            'descriptionIt' => self::getDescription()->getIt(),
            'brandId' => self::getBrand()->getId(),
            'currencyId' => self::getCurrency() ? self::getCurrency()->getId() : null
        ];
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
    protected function setName(Name $name): RatingPlanGroupInterface
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
    protected function setDescription(Description $description): RatingPlanGroupInterface
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
    protected function setBrand(BrandInterface $brand): RatingPlanGroupInterface
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

    /**
     * Set currency
     *
     * @param CurrencyInterface | null
     *
     * @return static
     */
    protected function setCurrency(?CurrencyInterface $currency = null): RatingPlanGroupInterface
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * Get currency
     *
     * @return CurrencyInterface | null
     */
    public function getCurrency(): ?CurrencyInterface
    {
        return $this->currency;
    }

}
