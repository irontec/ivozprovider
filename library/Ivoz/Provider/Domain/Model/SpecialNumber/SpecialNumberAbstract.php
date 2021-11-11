<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\SpecialNumber;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Country\CountryInterface;
use Ivoz\Provider\Domain\Model\Brand\Brand;
use Ivoz\Provider\Domain\Model\Country\Country;

/**
* SpecialNumberAbstract
* @codeCoverageIgnore
*/
abstract class SpecialNumberAbstract
{
    use ChangelogTrait;

    protected $number;

    protected $numberE164;

    protected $disableCDR = 1;

    /**
     * @var BrandInterface | null
     */
    protected $brand;

    /**
     * @var CountryInterface
     */
    protected $country;

    /**
     * Constructor
     */
    protected function __construct(
        string $number,
        int $disableCDR
    ) {
        $this->setNumber($number);
        $this->setDisableCDR($disableCDR);
    }

    abstract public function getId(): null|string|int;

    public function __toString(): string
    {
        return sprintf(
            "%s#%s",
            "SpecialNumber",
            (string) $this->getId()
        );
    }

    /**
     * @throws \Exception
     */
    protected function sanitizeValues(): void
    {
    }

    public static function createDto(string|int|null $id = null): SpecialNumberDto
    {
        return new SpecialNumberDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|SpecialNumberInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?SpecialNumberDto
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, SpecialNumberInterface::class);

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
     * @param SpecialNumberDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, SpecialNumberDto::class);

        $self = new static(
            $dto->getNumber(),
            $dto->getDisableCDR()
        );

        $self
            ->setNumberE164($dto->getNumberE164())
            ->setBrand($fkTransformer->transform($dto->getBrand()))
            ->setCountry($fkTransformer->transform($dto->getCountry()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param SpecialNumberDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, SpecialNumberDto::class);

        $this
            ->setNumber($dto->getNumber())
            ->setNumberE164($dto->getNumberE164())
            ->setDisableCDR($dto->getDisableCDR())
            ->setBrand($fkTransformer->transform($dto->getBrand()))
            ->setCountry($fkTransformer->transform($dto->getCountry()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): SpecialNumberDto
    {
        return self::createDto()
            ->setNumber(self::getNumber())
            ->setNumberE164(self::getNumberE164())
            ->setDisableCDR(self::getDisableCDR())
            ->setBrand(Brand::entityToDto(self::getBrand(), $depth))
            ->setCountry(Country::entityToDto(self::getCountry(), $depth));
    }

    protected function __toArray(): array
    {
        return [
            'number' => self::getNumber(),
            'numberE164' => self::getNumberE164(),
            'disableCDR' => self::getDisableCDR(),
            'brandId' => self::getBrand()?->getId(),
            'countryId' => self::getCountry()->getId()
        ];
    }

    protected function setNumber(string $number): static
    {
        Assertion::maxLength($number, 25, 'number value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->number = $number;

        return $this;
    }

    public function getNumber(): string
    {
        return $this->number;
    }

    protected function setNumberE164(?string $numberE164 = null): static
    {
        if (!is_null($numberE164)) {
            Assertion::maxLength($numberE164, 25, 'numberE164 value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->numberE164 = $numberE164;

        return $this;
    }

    public function getNumberE164(): ?string
    {
        return $this->numberE164;
    }

    protected function setDisableCDR(int $disableCDR): static
    {
        Assertion::greaterOrEqualThan($disableCDR, 0, 'disableCDR provided "%s" is not greater or equal than "%s".');

        $this->disableCDR = $disableCDR;

        return $this;
    }

    public function getDisableCDR(): int
    {
        return $this->disableCDR;
    }

    protected function setBrand(?BrandInterface $brand = null): static
    {
        $this->brand = $brand;

        return $this;
    }

    public function getBrand(): ?BrandInterface
    {
        return $this->brand;
    }

    protected function setCountry(CountryInterface $country): static
    {
        $this->country = $country;

        return $this;
    }

    public function getCountry(): CountryInterface
    {
        return $this->country;
    }
}
