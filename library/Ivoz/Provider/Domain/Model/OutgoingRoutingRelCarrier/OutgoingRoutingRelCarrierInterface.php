<?php

namespace Ivoz\Provider\Domain\Model\OutgoingRoutingRelCarrier;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface;
use Ivoz\Provider\Domain\Model\Carrier\CarrierInterface;
use Ivoz\Cgr\Domain\Model\TpRatingProfile\TpRatingProfileInterface;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;

/**
* OutgoingRoutingRelCarrierInterface
*/
interface OutgoingRoutingRelCarrierInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array<string, mixed>
     */
    public function getChangeSet(): array;

    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId(): ?int;

    public static function createDto(string|int|null $id = null): OutgoingRoutingRelCarrierDto;

    /**
     * @internal use EntityTools instead
     * @param null|OutgoingRoutingRelCarrierInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?OutgoingRoutingRelCarrierDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param OutgoingRoutingRelCarrierDto $dto
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): OutgoingRoutingRelCarrierDto;

    public function setOutgoingRouting(?OutgoingRoutingInterface $outgoingRouting = null): static;

    public function getOutgoingRouting(): ?OutgoingRoutingInterface;

    public function setCarrier(CarrierInterface $carrier): static;

    public function getCarrier(): CarrierInterface;

    public function addTpRatingProfile(TpRatingProfileInterface $tpRatingProfile): OutgoingRoutingRelCarrierInterface;

    public function removeTpRatingProfile(TpRatingProfileInterface $tpRatingProfile): OutgoingRoutingRelCarrierInterface;

    /**
     * @param Collection<array-key, TpRatingProfileInterface> $tpRatingProfiles
     */
    public function replaceTpRatingProfiles(Collection $tpRatingProfiles): OutgoingRoutingRelCarrierInterface;

    /**
     * @return array<array-key, TpRatingProfileInterface>
     */
    public function getTpRatingProfiles(?Criteria $criteria = null): array;
}
