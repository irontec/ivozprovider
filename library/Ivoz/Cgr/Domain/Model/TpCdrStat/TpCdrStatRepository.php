<?php

namespace Ivoz\Cgr\Domain\Model\TpCdrStat;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Persistence\ObjectRepository;

interface TpCdrStatRepository extends ObjectRepository, Selectable
{
}
