<?php

namespace Ivoz\Provider\Domain\Model\OutgoingRoutingRelCarrier;

use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface;
use Ivoz\Provider\Domain\Model\Carrier\CarrierInterface;
use Ivoz\Cgr\Domain\Model\TpRatingProfile\TpRatingProfileInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;

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

    /**
     * Set outgoingRouting
     *
     * @param OutgoingRoutingInterface | null
     *
     * @return static
     */
    public function setOutgoingRouting(?OutgoingRoutingInterface $outgoingRouting = null): OutgoingRoutingRelCarrierInterface;

    /**
     * Get outgoingRouting
     *
     * @return OutgoingRoutingInterface | null
     */
    public function getOutgoingRouting(): ?OutgoingRoutingInterface;

    /**
     * Set carrier
     *
     * @param CarrierInterface
     *
     * @return static
     */
    public function setCarrier(CarrierInterface $carrier): OutgoingRoutingRelCarrierInterface;

    /**
     * Get carrier
     *
     * @return CarrierInterface
     */
    public function getCarrier(): CarrierInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

    /**
     * Add tpRatingProfile
     *
     * @param TpRatingProfileInterface $tpRatingProfile
     *
     * @return static
     */
    public function addTpRatingProfile(TpRatingProfileInterface $tpRatingProfile): OutgoingRoutingRelCarrierInterface;

    /**
     * Remove tpRatingProfile
     *
     * @param TpRatingProfileInterface $tpRatingProfile
     *
     * @return static
     */
    public function removeTpRatingProfile(TpRatingProfileInterface $tpRatingProfile): OutgoingRoutingRelCarrierInterface;

    /**
     * Replace tpRatingProfiles
     *
     * @param ArrayCollection $tpRatingProfiles of TpRatingProfileInterface
     *
     * @return static
     */
    public function replaceTpRatingProfiles(ArrayCollection $tpRatingProfiles): OutgoingRoutingRelCarrierInterface;

    /**
     * Get tpRatingProfiles
     * @param Criteria | null $criteria
     * @return TpRatingProfileInterface[]
     */
    public function getTpRatingProfiles(?Criteria $criteria = null): array;

}
