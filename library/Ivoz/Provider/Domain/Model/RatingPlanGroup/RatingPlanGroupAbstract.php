<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\RatingPlanGroup;

use Assert\Assertion;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Domain\ForeignKeyTransformerInterface;
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
     * @var Name
     */
    protected $name;

    /**
     * @var Description
     */
    protected $description;

    /**
     * @var BrandInterface
     */
    protected $brand;

    /**
     * @var ?CurrencyInterface
     */
    protected $currency = null;

    /**
     * Constructor
     */
    protected function __construct(
        Name $name,
        Description $description
    ) {
        $this->name = $name;
        $this->description = $description;
    }

    abstract public function getId(): null|string|int;

    public function __toString(): string
    {
        return sprintf(
            "%s#%s",
            "RatingPlanGroup",
            (string) $this->getId()
        );
    }

    /**
     * @throws \Exception
     */
    protected function sanitizeValues(): void
    {
    }

    public static function createDto(string|int|null $id = null): RatingPlanGroupDto
    {
        return new RatingPlanGroupDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|RatingPlanGroupInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?RatingPlanGroupDto
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

        $dto = $entity->toDto($depth - 1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param RatingPlanGroupDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, RatingPlanGroupDto::class);
        $nameEn = $dto->getNameEn();
        Assertion::notNull($nameEn, 'nameEn value is null, but non null value was expected.');
        $nameEs = $dto->getNameEs();
        Assertion::notNull($nameEs, 'nameEs value is null, but non null value was expected.');
        $nameCa = $dto->getNameCa();
        Assertion::notNull($nameCa, 'nameCa value is null, but non null value was expected.');
        $nameIt = $dto->getNameIt();
        Assertion::notNull($nameIt, 'nameIt value is null, but non null value was expected.');
        $descriptionEn = $dto->getDescriptionEn();
        Assertion::notNull($descriptionEn, 'descriptionEn value is null, but non null value was expected.');
        $descriptionEs = $dto->getDescriptionEs();
        Assertion::notNull($descriptionEs, 'descriptionEs value is null, but non null value was expected.');
        $descriptionCa = $dto->getDescriptionCa();
        Assertion::notNull($descriptionCa, 'descriptionCa value is null, but non null value was expected.');
        $descriptionIt = $dto->getDescriptionIt();
        Assertion::notNull($descriptionIt, 'descriptionIt value is null, but non null value was expected.');
        $brand = $dto->getBrand();
        Assertion::notNull($brand, 'getBrand value is null, but non null value was expected.');

        $name = new Name(
            $nameEn,
            $nameEs,
            $nameCa,
            $nameIt
        );

        $description = new Description(
            $descriptionEn,
            $descriptionEs,
            $descriptionCa,
            $descriptionIt
        );

        $self = new static(
            $name,
            $description
        );

        $self
            ->setBrand($fkTransformer->transform($brand))
            ->setCurrency($fkTransformer->transform($dto->getCurrency()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param RatingPlanGroupDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, RatingPlanGroupDto::class);

        $nameEn = $dto->getNameEn();
        Assertion::notNull($nameEn, 'nameEn value is null, but non null value was expected.');
        $nameEs = $dto->getNameEs();
        Assertion::notNull($nameEs, 'nameEs value is null, but non null value was expected.');
        $nameCa = $dto->getNameCa();
        Assertion::notNull($nameCa, 'nameCa value is null, but non null value was expected.');
        $nameIt = $dto->getNameIt();
        Assertion::notNull($nameIt, 'nameIt value is null, but non null value was expected.');
        $descriptionEn = $dto->getDescriptionEn();
        Assertion::notNull($descriptionEn, 'descriptionEn value is null, but non null value was expected.');
        $descriptionEs = $dto->getDescriptionEs();
        Assertion::notNull($descriptionEs, 'descriptionEs value is null, but non null value was expected.');
        $descriptionCa = $dto->getDescriptionCa();
        Assertion::notNull($descriptionCa, 'descriptionCa value is null, but non null value was expected.');
        $descriptionIt = $dto->getDescriptionIt();
        Assertion::notNull($descriptionIt, 'descriptionIt value is null, but non null value was expected.');
        $brand = $dto->getBrand();
        Assertion::notNull($brand, 'getBrand value is null, but non null value was expected.');

        $name = new Name(
            $nameEn,
            $nameEs,
            $nameCa,
            $nameIt
        );

        $description = new Description(
            $descriptionEn,
            $descriptionEs,
            $descriptionCa,
            $descriptionIt
        );

        $this
            ->setName($name)
            ->setDescription($description)
            ->setBrand($fkTransformer->transform($brand))
            ->setCurrency($fkTransformer->transform($dto->getCurrency()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): RatingPlanGroupDto
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
     * @return array<string, mixed>
     */
    protected function __toArray(): array
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
            'currencyId' => self::getCurrency()?->getId()
        ];
    }

    public function getName(): Name
    {
        return $this->name;
    }

    protected function setName(Name $name): static
    {
        $isEqual = $this->name->equals($name);
        if ($isEqual) {
            return $this;
        }

        $this->name = $name;
        return $this;
    }

    public function getDescription(): Description
    {
        return $this->description;
    }

    protected function setDescription(Description $description): static
    {
        $isEqual = $this->description->equals($description);
        if ($isEqual) {
            return $this;
        }

        $this->description = $description;
        return $this;
    }

    protected function setBrand(BrandInterface $brand): static
    {
        $this->brand = $brand;

        return $this;
    }

    public function getBrand(): BrandInterface
    {
        return $this->brand;
    }

    protected function setCurrency(?CurrencyInterface $currency = null): static
    {
        $this->currency = $currency;

        return $this;
    }

    public function getCurrency(): ?CurrencyInterface
    {
        return $this->currency;
    }
}
