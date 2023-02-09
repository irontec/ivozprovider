<?php

namespace Ivoz\Cgr\Domain\Model\TpTiming;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Persistence\ObjectRepository;

interface TpTimingRepository extends ObjectRepository, Selectable
{
}
