<?php

namespace Ivoz\Cgr\Domain\Service\TpRatingProfile;

use Doctrine\Common\Collections\ArrayCollection;
use Ivoz\Cgr\Domain\Model\TpRatingProfile\TpRatingProfile;
use Ivoz\Cgr\Domain\Model\TpRatingProfile\TpRatingProfileDto;
use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\RatingProfile\RatingProfileInterface;
use Ivoz\Provider\Domain\Service\RatingProfile\RatingProfileLifecycleEventHandlerInterface;

class UpdateByRatingProfile implements RatingProfileLifecycleEventHandlerInterface
{
    const POST_PERSIST_PRIORITY = self::PRIORITY_NORMAL;

    /**
     * @var EntityTools
     */
    protected $entityTools;

    public function __construct(
        EntityTools $entityTools
    ) {
        $this->entityTools = $entityTools;
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_POST_PERSIST => self::POST_PERSIST_PRIORITY
        ];
    }

    public function execute(RatingProfileInterface $ratingProfile)
    {
        $tpRatingProfile = $ratingProfile->getCgrRatingProfile();

        /** @var TpRatingProfileDto $tpRatingProfileDto */
        $tpRatingProfileDto = is_null($tpRatingProfile)
            ? TpRatingProfile::createDto()
            : $this->entityTools->entityToDto($tpRatingProfile);

        $company = $ratingProfile->getCompany();
        $carrier = $ratingProfile->getCarrier();

        if ($company) {
            $brand = $company->getBrand();
        } else {
            $brand = $carrier->getBrand();
        }

        $ratingPlanGroup = $ratingProfile->getRatingPlanGroup();
        $routingTag = $ratingProfile->getRoutingTag();

        // Update/Create TpRatingPorfile for this RatingProfile
        $tpRatingProfileDto
            ->setTpid($brand->getCgrTenant())
            ->setActivationTime($ratingProfile->getActivationTime()->format("Y-m-d H:i:s"))
            ->setTenant($brand->getCgrTenant())
            ->setRatingPlanTag($ratingPlanGroup->getCgrTag())
            ->setRatingProfileId($ratingProfile->getId());


        if ($company) {
            $tpRatingProfileDto->setSubject($company->getCgrSubject());
        }

        if ($carrier) {
            $tpRatingProfileDto
                ->setSubject($carrier->getCgrSubject())
                ->setCdrStatQueueIds($carrier->getCgrSubject());
        }

        if ($routingTag) {
            // Append Routing Tag subject code
            $tpRatingProfileDto->setSubject(
                $tpRatingProfileDto->getSubject() . $routingTag->getCgrSubject()
            );
        }

        $tpRatingProfile = $this->entityTools->persistDto(
            $tpRatingProfileDto,
            $tpRatingProfile,
            true
        );

        $ratingProfile
            ->replaceTpRatingProfiles(new ArrayCollection([$tpRatingProfile]));

        $this->entityTools->persist($ratingProfile);
    }
}
