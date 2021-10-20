<?php

namespace Ivoz\Provider\Domain\Model\Carrier;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetInterface;
use Ivoz\Provider\Domain\Model\Currency\CurrencyInterface;
use Ivoz\Provider\Domain\Model\ProxyTrunk\ProxyTrunkInterface;
use Ivoz\Provider\Domain\Model\MediaRelaySet\MediaRelaySetInterface;
use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface;
use Doctrine\Common\Collections\ArrayCollection;
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
     * @return array
     */
    public function getChangeSet(): array;

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

    public function isInitialized(): bool;

    public function addOutgoingRouting(OutgoingRoutingInterface $outgoingRouting): CarrierInterface;

    public function removeOutgoingRouting(OutgoingRoutingInterface $outgoingRouting): CarrierInterface;

    public function replaceOutgoingRoutings(ArrayCollection $outgoingRoutings): CarrierInterface;

    public function getOutgoingRoutings(?Criteria $criteria = null): array;

    public function addOutgoingRoutingsRelCarrier(OutgoingRoutingRelCarrierInterface $outgoingRoutingsRelCarrier): CarrierInterface;

    public function removeOutgoingRoutingsRelCarrier(OutgoingRoutingRelCarrierInterface $outgoingRoutingsRelCarrier): CarrierInterface;

    public function replaceOutgoingRoutingsRelCarriers(ArrayCollection $outgoingRoutingsRelCarriers): CarrierInterface;

    public function getOutgoingRoutingsRelCarriers(?Criteria $criteria = null): array;

    public function addServer(CarrierServerInterface $server): CarrierInterface;

    public function removeServer(CarrierServerInterface $server): CarrierInterface;

    public function replaceServers(ArrayCollection $servers): CarrierInterface;

    public function getServers(?Criteria $criteria = null): array;

    public function addRatingProfile(RatingProfileInterface $ratingProfile): CarrierInterface;

    public function removeRatingProfile(RatingProfileInterface $ratingProfile): CarrierInterface;

    public function replaceRatingProfiles(ArrayCollection $ratingProfiles): CarrierInterface;

    public function getRatingProfiles(?Criteria $criteria = null): array;

    public function addTpCdrStat(TpCdrStatInterface $tpCdrStat): CarrierInterface;

    public function removeTpCdrStat(TpCdrStatInterface $tpCdrStat): CarrierInterface;

    public function replaceTpCdrStats(ArrayCollection $tpCdrStats): CarrierInterface;

    public function getTpCdrStats(?Criteria $criteria = null): array;
}
