<?php

namespace Ivoz\Provider\Domain\Model\OutgoingDdiRule;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface OutgoingDdiRuleRepository extends ObjectRepository, Selectable {}

