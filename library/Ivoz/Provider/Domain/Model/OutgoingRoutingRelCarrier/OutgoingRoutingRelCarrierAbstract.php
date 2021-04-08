<?php
declare(strict_types = 1);

namespace Ivoz\Provider\Domain\Model\OutgoingRoutingRelCarrier;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use \Ivoz\Core\Application\ForeignKeyTransformerInterface;
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
     * @var OutgoingRoutingInterface | null
     * inversedBy relCarriers
     */
    protected $outgoingRouting;

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

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "OutgoingRoutingRelCarrier",
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
     * @param mixed $id
     * @return OutgoingRoutingRelCarrierDto
     */
    public static function createDto($id = null)
    {
        return new OutgoingRoutingRelCarrierDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param OutgoingRoutingRelCarrierInterface|null $entity
     * @param int $depth
     * @return OutgoingRoutingRelCarrierDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
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

        /** @var OutgoingRoutingRelCarrierDto $dto */
        $dto = $entity->toDto($depth-1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param OutgoingRoutingRelCarrierDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, OutgoingRoutingRelCarrierDto::class);

        $self = new static();

        $self
            ->setOutgoingRouting($fkTransformer->transform($dto->getOutgoingRouting()))
            ->setCarrier($fkTransformer->transform($dto->getCarrier()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param OutgoingRoutingRelCarrierDto $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, OutgoingRoutingRelCarrierDto::class);

        $this
            ->setOutgoingRouting($fkTransformer->transform($dto->getOutgoingRouting()))
            ->setCarrier($fkTransformer->transform($dto->getCarrier()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return OutgoingRoutingRelCarrierDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setOutgoingRouting(OutgoingRouting::entityToDto(self::getOutgoingRouting(), $depth))
            ->setCarrier(Carrier::entityToDto(self::getCarrier(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'outgoingRoutingId' => self::getOutgoingRouting() ? self::getOutgoingRouting()->getId() : null,
            'carrierId' => self::getCarrier()->getId()
        ];
    }

    public function setOutgoingRouting(?OutgoingRoutingInterface $outgoingRouting = null): static
    {
        $this->outgoingRouting = $outgoingRouting;

        /** @var  $this */
        return $this;
    }

    public function getOutgoingRouting(): ?OutgoingRoutingInterface
    {
        return $this->outgoingRouting;
    }

    public function setCarrier(CarrierInterface $carrier): static
    {
        $this->carrier = $carrier;

        /** @var  $this */
        return $this;
    }

    public function getCarrier(): CarrierInterface
    {
        return $this->carrier;
    }
}
