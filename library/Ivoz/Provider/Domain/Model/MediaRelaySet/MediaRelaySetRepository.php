<?php

namespace Ivoz\Provider\Domain\Model\MediaRelaySet;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Persistence\ObjectRepository;

interface MediaRelaySetRepository extends ObjectRepository, Selectable
{

}
