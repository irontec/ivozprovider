<?php

namespace Ivoz\Provider\Domain\Service\RatingProfile;

use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Provider\Domain\Model\RatingProfile\RatingProfileInterface;

interface RatingProfileLifecycleEventHandlerInterface extends LifecycleEventHandlerInterface
{
    public function execute(RatingProfileInterface $entity);
}
