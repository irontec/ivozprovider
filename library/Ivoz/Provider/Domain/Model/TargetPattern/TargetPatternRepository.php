<?php

namespace Ivoz\Provider\Domain\Model\TargetPattern;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface TargetPatternRepository extends ObjectRepository, Selectable {}

