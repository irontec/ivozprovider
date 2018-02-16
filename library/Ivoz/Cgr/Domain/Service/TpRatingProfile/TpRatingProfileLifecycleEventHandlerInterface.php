<?php

namespace Ivoz\Cgr\Domain\Service\TpRatingProfile;

use Ivoz\Cgr\Domain\Model\TpRatingProfile\TpRatingProfileInterface;

interface TpRatingProfileLifecycleEventHandlerInterface
{
    public function execute(TpRatingProfileInterface $entity);
}