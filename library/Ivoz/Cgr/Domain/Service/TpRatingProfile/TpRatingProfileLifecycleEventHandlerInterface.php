<?php

namespace Ivoz\Cgr\Domain\Service\TpRatingProfile;

use Ivoz\Cgr\Domain\Model\TpRatingProfile\TpRatingProfileInterface;
use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;

interface TpRatingProfileLifecycleEventHandlerInterface extends LifecycleEventHandlerInterface
{
    public function execute(TpRatingProfileInterface $tpRatingProfile);
}