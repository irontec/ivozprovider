<?php

namespace Ivoz\Cgr\Domain\Service\TpRatingProfile;

use Ivoz\Cgr\Domain\Model\TpRatingProfile\TpRatingProfileInterface;

class UpdateRatingProfileTag implements TpRatingProfileLifecycleEventHandlerInterface
{
    public function execute(TpRatingProfileInterface $entity)
    {
        $compay = $entity->getCompany();
        $brand = $compay->getBrand();
        $ratingPlan = $entity->getRatingPlan();

        $entity
            ->setTenant(sprintf("b%d", $brand->getId()))
            ->setSubject(sprintf("c%d", $compay->getId()))
            ->setRatingPlanTag($ratingPlan->getTag());

    }

}
