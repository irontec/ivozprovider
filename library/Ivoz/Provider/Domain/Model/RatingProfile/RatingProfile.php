<?php

namespace Ivoz\Provider\Domain\Model\RatingProfile;

use Ivoz\Cgr\Domain\Model\TpRatingProfile\TpRatingProfileInterface;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\Model\Helper\CriteriaHelper;

/**
 * RatingProfile
 */
class RatingProfile extends RatingProfileAbstract implements RatingProfileInterface
{
    use RatingProfileTrait;

    /**
     * @codeCoverageIgnore
     * @return array<string, mixed>
     */
    public function getChangeSet(): array
    {
        return parent::getChangeSet();
    }

    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Return the TpRatingProfile row associated with this RatingProfile
     *
     * @return TpRatingProfileInterface|mixed
     */
    public function getCgrRatingProfile()
    {
        $tpRatingProfiles = $this->getTpRatingProfiles(
            CriteriaHelper::fromArray([
                [ 'outgoingRoutingRelCarrier', 'isNull' ]
            ])
        );

        return array_shift($tpRatingProfiles);
    }
}
