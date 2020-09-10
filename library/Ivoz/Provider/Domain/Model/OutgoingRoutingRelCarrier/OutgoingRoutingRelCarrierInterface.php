<?php

namespace Ivoz\Provider\Domain\Model\OutgoingRoutingRelCarrier;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Common\Collections\ArrayCollection;

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
     * @param \Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface $outgoingRouting | null
     *
     * @return static
     */
    public function setOutgoingRouting(\Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface $outgoingRouting = null);

    /**
     * Get outgoingRouting
     *
     * @return \Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface | null
     */
    public function getOutgoingRouting();

    /**
     * Set carrier
     *
     * @param \Ivoz\Provider\Domain\Model\Carrier\CarrierInterface $carrier
     *
     * @return static
     */
    public function setCarrier(\Ivoz\Provider\Domain\Model\Carrier\CarrierInterface $carrier);

    /**
     * Get carrier
     *
     * @return \Ivoz\Provider\Domain\Model\Carrier\CarrierInterface
     */
    public function getCarrier();

    /**
     * @return bool
     */
    public function isInitialized(): bool;

    /**
     * Add tpRatingProfile
     *
     * @param \Ivoz\Cgr\Domain\Model\TpRatingProfile\TpRatingProfileInterface $tpRatingProfile
     *
     * @return static
     */
    public function addTpRatingProfile(\Ivoz\Cgr\Domain\Model\TpRatingProfile\TpRatingProfileInterface $tpRatingProfile);

    /**
     * Remove tpRatingProfile
     *
     * @param \Ivoz\Cgr\Domain\Model\TpRatingProfile\TpRatingProfileInterface $tpRatingProfile
     */
    public function removeTpRatingProfile(\Ivoz\Cgr\Domain\Model\TpRatingProfile\TpRatingProfileInterface $tpRatingProfile);

    /**
     * Replace tpRatingProfiles
     *
     * @param ArrayCollection $tpRatingProfiles of Ivoz\Cgr\Domain\Model\TpRatingProfile\TpRatingProfileInterface
     * @return static
     */
    public function replaceTpRatingProfiles(ArrayCollection $tpRatingProfiles);

    /**
     * Get tpRatingProfiles
     * @param Criteria | null $criteria
     * @return \Ivoz\Cgr\Domain\Model\TpRatingProfile\TpRatingProfileInterface[]
     */
    public function getTpRatingProfiles(\Doctrine\Common\Collections\Criteria $criteria = null);
}
