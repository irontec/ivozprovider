<?php

namespace Ivoz\Provider\Domain\Model\LcrRule;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface LcrRuleRepository extends ObjectRepository, Selectable {}

