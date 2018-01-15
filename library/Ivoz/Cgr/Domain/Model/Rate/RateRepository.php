<?php

namespace Ivoz\Cgr\Domain\Model\Rate;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface RateRepository extends ObjectRepository, Selectable
{

}

