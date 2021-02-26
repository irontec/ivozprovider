<?php

namespace Ivoz\Provider\Domain\Model\OutgoingRoutingRelCarrier;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface;
use Ivoz\Provider\Domain\Model\Carrier\CarrierInterface;
use Ivoz\Cgr\Domain\Model\TpRatingProfile\TpRatingProfileInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;

/**
* OutgoingRoutingRelCarrierInterface
*/
interface OutgoingRoutingRelCarrierInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    public function setOutgoingRouting(?OutgoingRoutingInterface $outgoingRouting = null): static;

    public function getOutgoingRouting(): ?OutgoingRoutingInterface;

    public function setCarrier(CarrierInterface $carrier): static;

    public function getCarrier(): CarrierInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

    public function addTpRatingProfile(TpRatingProfileInterface $tpRatingProfile): OutgoingRoutingRelCarrierInterface;

    public function removeTpRatingProfile(TpRatingProfileInterface $tpRatingProfile): OutgoingRoutingRelCarrierInterface;

    public function replaceTpRatingProfiles(ArrayCollection $tpRatingProfiles): OutgoingRoutingRelCarrierInterface;

    public function getTpRatingProfiles(?Criteria $criteria = null): array;

}
