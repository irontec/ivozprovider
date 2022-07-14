<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\FixedCostsRelInvoiceScheduler;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\FixedCost\FixedCostInterface;
use Ivoz\Provider\Domain\Model\InvoiceScheduler\InvoiceSchedulerInterface;
use Ivoz\Provider\Domain\Model\Country\CountryInterface;
use Ivoz\Provider\Domain\Model\FixedCost\FixedCost;
use Ivoz\Provider\Domain\Model\InvoiceScheduler\InvoiceScheduler;
use Ivoz\Provider\Domain\Model\Country\Country;

/**
* FixedCostsRelInvoiceSchedulerAbstract
* @codeCoverageIgnore
*/
abstract class FixedCostsRelInvoiceSchedulerAbstract
{
    use ChangelogTrait;

    /**
     * @var ?int
     */
    protected $quantity = null;

    /**
     * @var string
     * comment: enum:static|maxcalls|ddis
     */
    protected $type = 'static';

    /**
     * @var ?string
     * comment: enum:all|national|international|specific
     */
    protected $ddisCountryMatch = 'all';

    /**
     * @var FixedCostInterface
     */
    protected $fixedCost;

    /**
     * @var ?InvoiceSchedulerInterface
     * inversedBy relFixedCosts
     */
    protected $invoiceScheduler = null;

    /**
     * @var ?CountryInterface
     */
    protected $ddisCountry = null;

    /**
     * Constructor
     */
    protected function __construct(
        string $type
    ) {
        $this->setType($type);
    }

    abstract public function getId(): null|string|int;

    public function __toString(): string
    {
        return sprintf(
            "%s#%s",
            "FixedCostsRelInvoiceScheduler",
            (string) $this->getId()
        );
    }

    /**
     * @throws \Exception
     */
    protected function sanitizeValues(): void
    {
    }

    public static function createDto(string|int|null $id = null): FixedCostsRelInvoiceSchedulerDto
    {
        return new FixedCostsRelInvoiceSchedulerDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|FixedCostsRelInvoiceSchedulerInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?FixedCostsRelInvoiceSchedulerDto
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, FixedCostsRelInvoiceSchedulerInterface::class);

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
     * @param FixedCostsRelInvoiceSchedulerDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, FixedCostsRelInvoiceSchedulerDto::class);
        $type = $dto->getType();
        Assertion::notNull($type, 'getType value is null, but non null value was expected.');
        $fixedCost = $dto->getFixedCost();
        Assertion::notNull($fixedCost, 'getFixedCost value is null, but non null value was expected.');

        $self = new static(
            $type
        );

        $self
            ->setQuantity($dto->getQuantity())
            ->setDdisCountryMatch($dto->getDdisCountryMatch())
            ->setFixedCost($fkTransformer->transform($fixedCost))
            ->setInvoiceScheduler($fkTransformer->transform($dto->getInvoiceScheduler()))
            ->setDdisCountry($fkTransformer->transform($dto->getDdisCountry()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param FixedCostsRelInvoiceSchedulerDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, FixedCostsRelInvoiceSchedulerDto::class);

        $type = $dto->getType();
        Assertion::notNull($type, 'getType value is null, but non null value was expected.');
        $fixedCost = $dto->getFixedCost();
        Assertion::notNull($fixedCost, 'getFixedCost value is null, but non null value was expected.');

        $this
            ->setQuantity($dto->getQuantity())
            ->setType($type)
            ->setDdisCountryMatch($dto->getDdisCountryMatch())
            ->setFixedCost($fkTransformer->transform($fixedCost))
            ->setInvoiceScheduler($fkTransformer->transform($dto->getInvoiceScheduler()))
            ->setDdisCountry($fkTransformer->transform($dto->getDdisCountry()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): FixedCostsRelInvoiceSchedulerDto
    {
        return self::createDto()
            ->setQuantity(self::getQuantity())
            ->setType(self::getType())
            ->setDdisCountryMatch(self::getDdisCountryMatch())
            ->setFixedCost(FixedCost::entityToDto(self::getFixedCost(), $depth))
            ->setInvoiceScheduler(InvoiceScheduler::entityToDto(self::getInvoiceScheduler(), $depth))
            ->setDdisCountry(Country::entityToDto(self::getDdisCountry(), $depth));
    }

    /**
     * @return array<string, mixed>
     */
    protected function __toArray(): array
    {
        return [
            'quantity' => self::getQuantity(),
            'type' => self::getType(),
            'ddisCountryMatch' => self::getDdisCountryMatch(),
            'fixedCostId' => self::getFixedCost()->getId(),
            'invoiceSchedulerId' => self::getInvoiceScheduler()?->getId(),
            'ddisCountryId' => self::getDdisCountry()?->getId()
        ];
    }

    protected function setQuantity(?int $quantity = null): static
    {
        if (!is_null($quantity)) {
            Assertion::greaterOrEqualThan($quantity, 0, 'quantity provided "%s" is not greater or equal than "%s".');
        }

        $this->quantity = $quantity;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    protected function setType(string $type): static
    {
        Assertion::maxLength($type, 25, 'type value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        Assertion::choice(
            $type,
            [
                FixedCostsRelInvoiceSchedulerInterface::TYPE_STATIC,
                FixedCostsRelInvoiceSchedulerInterface::TYPE_MAXCALLS,
                FixedCostsRelInvoiceSchedulerInterface::TYPE_DDIS,
            ],
            'typevalue "%s" is not an element of the valid values: %s'
        );

        $this->type = $type;

        return $this;
    }

    public function getType(): string
    {
        return $this->type;
    }

    protected function setDdisCountryMatch(?string $ddisCountryMatch = null): static
    {
        if (!is_null($ddisCountryMatch)) {
            Assertion::maxLength($ddisCountryMatch, 25, 'ddisCountryMatch value "%s" is too long, it should have no more than %d characters, but has %d characters.');
            Assertion::choice(
                $ddisCountryMatch,
                [
                    FixedCostsRelInvoiceSchedulerInterface::DDISCOUNTRYMATCH_ALL,
                    FixedCostsRelInvoiceSchedulerInterface::DDISCOUNTRYMATCH_NATIONAL,
                    FixedCostsRelInvoiceSchedulerInterface::DDISCOUNTRYMATCH_INTERNATIONAL,
                    FixedCostsRelInvoiceSchedulerInterface::DDISCOUNTRYMATCH_SPECIFIC,
                ],
                'ddisCountryMatchvalue "%s" is not an element of the valid values: %s'
            );
        }

        $this->ddisCountryMatch = $ddisCountryMatch;

        return $this;
    }

    public function getDdisCountryMatch(): ?string
    {
        return $this->ddisCountryMatch;
    }

    protected function setFixedCost(FixedCostInterface $fixedCost): static
    {
        $this->fixedCost = $fixedCost;

        return $this;
    }

    public function getFixedCost(): FixedCostInterface
    {
        return $this->fixedCost;
    }

    public function setInvoiceScheduler(?InvoiceSchedulerInterface $invoiceScheduler = null): static
    {
        $this->invoiceScheduler = $invoiceScheduler;

        return $this;
    }

    public function getInvoiceScheduler(): ?InvoiceSchedulerInterface
    {
        return $this->invoiceScheduler;
    }

    protected function setDdisCountry(?CountryInterface $ddisCountry = null): static
    {
        $this->ddisCountry = $ddisCountry;

        return $this;
    }

    public function getDdisCountry(): ?CountryInterface
    {
        return $this->ddisCountry;
    }
}
