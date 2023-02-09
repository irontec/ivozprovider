<?php

namespace Ivoz\Provider\Domain\Model\MatchListPattern;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Persistence\ObjectRepository;

interface MatchListPatternRepository extends ObjectRepository, Selectable
{
}
