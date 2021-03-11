<?php

namespace Ivoz\Provider\Domain\Model\OutgoingDdiRule;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Persistence\ObjectRepository;

interface OutgoingDdiRuleRepository extends ObjectRepository, Selectable
{

}
