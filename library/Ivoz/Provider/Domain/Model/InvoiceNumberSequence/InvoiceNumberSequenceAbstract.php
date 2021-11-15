<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\InvoiceNumberSequence;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Brand\Brand;

/**
* InvoiceNumberSequenceAbstract
* @codeCoverageIgnore
*/
abstract class InvoiceNumberSequenceAbstract
{
    use ChangelogTrait;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $prefix = '';

    /**
     * @var int
     */
    protected $sequenceLength;

    /**
     * @var int
     */
    protected $increment;

    /**
     * @var ?string
     */
    protected $latestValue = '';

    /**
     * @var int
     */
    protected $iteration = 0;

    /**
     * @var int
     */
    protected $version = 1;

    /**
     * @var BrandInterface
     */
    protected $brand;

    /**
     * Constructor
     */
    protected function __construct(
        string $name,
        string $prefix,
        int $sequenceLength,
        int $increment,
        int $iteration,
        int $version
    ) {
        $this->setName($name);
        $this->setPrefix($prefix);
        $this->setSequenceLength($sequenceLength);
        $this->setIncrement($increment);
        $this->setIteration($iteration);
        $this->setVersion($version);
    }

    abstract public function getId(): null|string|int;

    public function __toString(): string
    {
        return sprintf(
            "%s#%s",
            "InvoiceNumberSequence",
            (string) $this->getId()
        );
    }

    /**
     * @throws \Exception
     */
    protected function sanitizeValues(): void
    {
    }

    public static function createDto(string|int|null $id = null): InvoiceNumberSequenceDto
    {
        return new InvoiceNumberSequenceDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|InvoiceNumberSequenceInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?InvoiceNumberSequenceDto
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

        $dto = $entity->toDto($depth - 1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param InvoiceNumberSequenceDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, InvoiceNumberSequenceDto::class);
        $name = $dto->getName();
        Assertion::notNull($name, 'getName value is null, but non null value was expected.');
        $prefix = $dto->getPrefix();
        Assertion::notNull($prefix, 'getPrefix value is null, but non null value was expected.');
        $sequenceLength = $dto->getSequenceLength();
        Assertion::notNull($sequenceLength, 'getSequenceLength value is null, but non null value was expected.');
        $increment = $dto->getIncrement();
        Assertion::notNull($increment, 'getIncrement value is null, but non null value was expected.');
        $iteration = $dto->getIteration();
        Assertion::notNull($iteration, 'getIteration value is null, but non null value was expected.');
        $version = $dto->getVersion();
        Assertion::notNull($version, 'getVersion value is null, but non null value was expected.');
        $brand = $dto->getBrand();
        Assertion::notNull($brand, 'getBrand value is null, but non null value was expected.');

        $self = new static(
            $name,
            $prefix,
            $sequenceLength,
            $increment,
            $iteration,
            $version
        );

        $self
            ->setLatestValue($dto->getLatestValue())
            ->setBrand($fkTransformer->transform($brand));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param InvoiceNumberSequenceDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, InvoiceNumberSequenceDto::class);

        $name = $dto->getName();
        Assertion::notNull($name, 'getName value is null, but non null value was expected.');
        $prefix = $dto->getPrefix();
        Assertion::notNull($prefix, 'getPrefix value is null, but non null value was expected.');
        $sequenceLength = $dto->getSequenceLength();
        Assertion::notNull($sequenceLength, 'getSequenceLength value is null, but non null value was expected.');
        $increment = $dto->getIncrement();
        Assertion::notNull($increment, 'getIncrement value is null, but non null value was expected.');
        $iteration = $dto->getIteration();
        Assertion::notNull($iteration, 'getIteration value is null, but non null value was expected.');
        $version = $dto->getVersion();
        Assertion::notNull($version, 'getVersion value is null, but non null value was expected.');
        $brand = $dto->getBrand();
        Assertion::notNull($brand, 'getBrand value is null, but non null value was expected.');

        $this
            ->setName($name)
            ->setPrefix($prefix)
            ->setSequenceLength($sequenceLength)
            ->setIncrement($increment)
            ->setLatestValue($dto->getLatestValue())
            ->setIteration($iteration)
            ->setVersion($version)
            ->setBrand($fkTransformer->transform($brand));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): InvoiceNumberSequenceDto
    {
        return self::createDto()
            ->setName(self::getName())
            ->setPrefix(self::getPrefix())
            ->setSequenceLength(self::getSequenceLength())
            ->setIncrement(self::getIncrement())
            ->setLatestValue(self::getLatestValue())
            ->setIteration(self::getIteration())
            ->setVersion(self::getVersion())
            ->setBrand(Brand::entityToDto(self::getBrand(), $depth));
    }

    protected function __toArray(): array
    {
        return [
            'name' => self::getName(),
            'prefix' => self::getPrefix(),
            'sequenceLength' => self::getSequenceLength(),
            'increment' => self::getIncrement(),
            'latestValue' => self::getLatestValue(),
            'iteration' => self::getIteration(),
            'version' => self::getVersion(),
            'brandId' => self::getBrand()->getId()
        ];
    }

    protected function setName(string $name): static
    {
        Assertion::maxLength($name, 40, 'name value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->name = $name;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    protected function setPrefix(string $prefix): static
    {
        Assertion::maxLength($prefix, 20, 'prefix value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->prefix = $prefix;

        return $this;
    }

    public function getPrefix(): string
    {
        return $this->prefix;
    }

    protected function setSequenceLength(int $sequenceLength): static
    {
        Assertion::greaterOrEqualThan($sequenceLength, 0, 'sequenceLength provided "%s" is not greater or equal than "%s".');

        $this->sequenceLength = $sequenceLength;

        return $this;
    }

    public function getSequenceLength(): int
    {
        return $this->sequenceLength;
    }

    protected function setIncrement(int $increment): static
    {
        Assertion::greaterOrEqualThan($increment, 0, 'increment provided "%s" is not greater or equal than "%s".');

        $this->increment = $increment;

        return $this;
    }

    public function getIncrement(): int
    {
        return $this->increment;
    }

    protected function setLatestValue(?string $latestValue = null): static
    {
        $this->latestValue = $latestValue;

        return $this;
    }

    public function getLatestValue(): ?string
    {
        return $this->latestValue;
    }

    protected function setIteration(int $iteration): static
    {
        Assertion::greaterOrEqualThan($iteration, 0, 'iteration provided "%s" is not greater or equal than "%s".');

        $this->iteration = $iteration;

        return $this;
    }

    public function getIteration(): int
    {
        return $this->iteration;
    }

    protected function setVersion(int $version): static
    {
        $this->version = $version;

        return $this;
    }

    public function getVersion(): int
    {
        return $this->version;
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
}
