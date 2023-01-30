<?php

namespace Ivoz\Provider\Domain\Model\Carrier;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetInterface;
use Ivoz\Provider\Domain\Model\Currency\CurrencyInterface;
use Ivoz\Provider\Domain\Model\ProxyTrunk\ProxyTrunkInterface;
use Ivoz\Provider\Domain\Model\MediaRelaySet\MediaRelaySetInterface;
use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;
use Ivoz\Provider\Domain\Model\OutgoingRoutingRelCarrier\OutgoingRoutingRelCarrierInterface;
use Ivoz\Provider\Domain\Model\CarrierServer\CarrierServerInterface;
use Ivoz\Provider\Domain\Model\RatingProfile\RatingProfileInterface;
use Ivoz\Cgr\Domain\Model\TpCdrStat\TpCdrStatInterface;

/**
* CarrierInterface
*/
interface CarrierInterface extends LoggableEntityInterface
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

    /**
     * @return string
     */
    public function getCgrSubject(): string;

    /**
     * @return string
     */
    public function getCurrencySymbol(): string;

    /**
     * @return string
     */
    public function getCurrencyIden(): string;

    public static function createDto(string|int|null $id = null): CarrierDto;

    /**
     * @internal use EntityTools instead
     * @param null|CarrierInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?CarrierDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param CarrierDto $dto
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): CarrierDto;

    public function getDescription(): string;

    public function getName(): string;

    public function getExternallyRated(): ?bool;

    public function getBalance(): ?float;

    public function getCalculateCost(): ?bool;

    public function getBrand(): BrandInterface;

    public function getTransformationRuleSet(): ?TransformationRuleSetInterface;

    public function getCurrency(): ?CurrencyInterface;

    public function getProxyTrunk(): ?ProxyTrunkInterface;

    public function getMediaRelaySets(): ?MediaRelaySetInterface;

    public function addOutgoingRouting(OutgoingRoutingInterface $outgoingRouting): CarrierInterface;

    public function removeOutgoingRouting(OutgoingRoutingInterface $outgoingRouting): CarrierInterface;

    /**
     * @param Collection<array-key, OutgoingRoutingInterface> $outgoingRoutings
     */
    public function replaceOutgoingRoutings(Collection $outgoingRoutings): CarrierInterface;

    /**
     * @return array<array-key, OutgoingRoutingInterface>
     */
    public function getOutgoingRoutings(?Criteria $criteria = null): array;

    public function addOutgoingRoutingsRelCarrier(OutgoingRoutingRelCarrierInterface $outgoingRoutingsRelCarrier): CarrierInterface;

    public function removeOutgoingRoutingsRelCarrier(OutgoingRoutingRelCarrierInterface $outgoingRoutingsRelCarrier): CarrierInterface;

    /**
     * @param Collection<array-key, OutgoingRoutingRelCarrierInterface> $outgoingRoutingsRelCarriers
     */
    public function replaceOutgoingRoutingsRelCarriers(Collection $outgoingRoutingsRelCarriers): CarrierInterface;

    /**
     * @return array<array-key, OutgoingRoutingRelCarrierInterface>
     */
    public function getOutgoingRoutingsRelCarriers(?Criteria $criteria = null): array;

    public function addServer(CarrierServerInterface $server): CarrierInterface;

    public function removeServer(CarrierServerInterface $server): CarrierInterface;

    /**
     * @param Collection<array-key, CarrierServerInterface> $servers
     */
    public function replaceServers(Collection $servers): CarrierInterface;

    /**
     * @return array<array-key, CarrierServerInterface>
     */
    public function getServers(?Criteria $criteria = null): array;

    public function addRatingProfile(RatingProfileInterface $ratingProfile): CarrierInterface;

    public function removeRatingProfile(RatingProfileInterface $ratingProfile): CarrierInterface;

    /**
     * @param Collection<array-key, RatingProfileInterface> $ratingProfiles
     */
    public function replaceRatingProfiles(Collection $ratingProfiles): CarrierInterface;

    /**
     * @return array<array-key, RatingProfileInterface>
     */
    public function getRatingProfiles(?Criteria $criteria = null): array;

    public function addTpCdrStat(TpCdrStatInterface $tpCdrStat): CarrierInterface;

    public function removeTpCdrStat(TpCdrStatInterface $tpCdrStat): CarrierInterface;

    /**
     * @param Collection<array-key, TpCdrStatInterface> $tpCdrStats
     */
    public function replaceTpCdrStats(Collection $tpCdrStats): CarrierInterface;

    /**
     * @return array<array-key, TpCdrStatInterface>
     */
    public function getTpCdrStats(?Criteria $criteria = null): array;
}
