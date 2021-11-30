<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\OutgoingRoutingRelCarrier;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface;
use Ivoz\Provider\Domain\Model\Carrier\CarrierInterface;
use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRouting;
use Ivoz\Provider\Domain\Model\Carrier\Carrier;

/**
* OutgoingRoutingRelCarrierAbstract
* @codeCoverageIgnore
*/
abstract class OutgoingRoutingRelCarrierAbstract
{
    use ChangelogTrait;

    /**
     * @var ?OutgoingRoutingInterface
     * inversedBy relCarriers
     */
    protected $outgoingRouting = null;

    /**
     * @var CarrierInterface
     * inversedBy outgoingRoutingsRelCarriers
     */
    protected $carrier;

    /**
     * Constructor
     */
    protected function __construct()
    {
    }

    abstract public function getId(): null|string|int;

    public function __toString(): string
    {
        return sprintf(
            "%s#%s",
            "OutgoingRoutingRelCarrier",
            (string) $this->getId()
        );
    }

    /**
     * @throws \Exception
     */
    protected function sanitizeValues(): void
    {
    }

    public static function createDto(string|int|null $id = null): OutgoingRoutingRelCarrierDto
    {
        return new OutgoingRoutingRelCarrierDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|OutgoingRoutingRelCarrierInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?OutgoingRoutingRelCarrierDto
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, OutgoingRoutingRelCarrierInterface::class);

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
     * @param OutgoingRoutingRelCarrierDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, OutgoingRoutingRelCarrierDto::class);
        $carrier = $dto->getCarrier();
        Assertion::notNull($carrier, 'getCarrier value is null, but non null value was expected.');

        $self = new static();

        $self
            ->setOutgoingRouting($fkTransformer->transform($dto->getOutgoingRouting()))
            ->setCarrier($fkTransformer->transform($carrier));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param OutgoingRoutingRelCarrierDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, OutgoingRoutingRelCarrierDto::class);

        $carrier = $dto->getCarrier();
        Assertion::notNull($carrier, 'getCarrier value is null, but non null value was expected.');

        $this
            ->setOutgoingRouting($fkTransformer->transform($dto->getOutgoingRouting()))
            ->setCarrier($fkTransformer->transform($carrier));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): OutgoingRoutingRelCarrierDto
    {
        return self::createDto()
            ->setOutgoingRouting(OutgoingRouting::entityToDto(self::getOutgoingRouting(), $depth))
            ->setCarrier(Carrier::entityToDto(self::getCarrier(), $depth));
    }

    protected function __toArray(): array
    {
        return [
            'outgoingRoutingId' => self::getOutgoingRouting()?->getId(),
            'carrierId' => self::getCarrier()->getId()
        ];
    }

    public function setOutgoingRouting(?OutgoingRoutingInterface $outgoingRouting = null): static
    {
        $this->outgoingRouting = $outgoingRouting;

        return $this;
    }

    public function getOutgoingRouting(): ?OutgoingRoutingInterface
    {
        return $this->outgoingRouting;
    }

    public function setCarrier(CarrierInterface $carrier): static
    {
        $this->carrier = $carrier;

        return $this;
    }

    public function getCarrier(): CarrierInterface
    {
        return $this->carrier;
    }
}
