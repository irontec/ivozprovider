<?php

namespace Ivoz\Provider\Domain\Model\OutgoingRoutingRelCarrier;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
 * OutgoingRoutingRelCarrierAbstract
 * @codeCoverageIgnore
 */
abstract class OutgoingRoutingRelCarrierAbstract
{
    /**
     * @var \Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface | null
     */
    protected $outgoingRouting;

    /**
     * @var \Ivoz\Provider\Domain\Model\Carrier\CarrierInterface
     */
    protected $carrier;


    use ChangelogTrait;

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
     * @param null $id
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
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, OutgoingRoutingRelCarrierDto::class);

        $self = new static();

        $self
            ->setOutgoingRouting($fkTransformer->transform($dto->getOutgoingRouting()))
            ->setCarrier($fkTransformer->transform($dto->getCarrier()))
        ;

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
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
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
            ->setOutgoingRouting(\Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRouting::entityToDto(self::getOutgoingRouting(), $depth))
            ->setCarrier(\Ivoz\Provider\Domain\Model\Carrier\Carrier::entityToDto(self::getCarrier(), $depth));
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
    // @codeCoverageIgnoreStart

    /**
     * Set outgoingRouting
     *
     * @param \Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface $outgoingRouting | null
     *
     * @return static
     */
    public function setOutgoingRouting(\Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface $outgoingRouting = null)
    {
        $this->outgoingRouting = $outgoingRouting;

        return $this;
    }

    /**
     * Get outgoingRouting
     *
     * @return \Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface | null
     */
    public function getOutgoingRouting()
    {
        return $this->outgoingRouting;
    }

    /**
     * Set carrier
     *
     * @param \Ivoz\Provider\Domain\Model\Carrier\CarrierInterface $carrier
     *
     * @return static
     */
    public function setCarrier(\Ivoz\Provider\Domain\Model\Carrier\CarrierInterface $carrier)
    {
        $this->carrier = $carrier;

        return $this;
    }

    /**
     * Get carrier
     *
     * @return \Ivoz\Provider\Domain\Model\Carrier\CarrierInterface
     */
    public function getCarrier()
    {
        return $this->carrier;
    }

    // @codeCoverageIgnoreEnd
}
