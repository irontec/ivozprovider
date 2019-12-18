<?php

namespace Ivoz\Provider\Domain\Model\DdiProvider;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Common\Persistence\ObjectRepository;

interface DdiProviderRepository extends ObjectRepository, Selectable
{

}
