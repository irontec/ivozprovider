<?php

namespace Ivoz\Provider\Domain\Model\DdiProvider;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface DdiProviderRepository extends  ObjectRepository, Selectable
{

}


