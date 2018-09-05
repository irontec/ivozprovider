<?php

namespace Ivoz\Provider\Domain\Model\Service;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface ServiceRepository extends ObjectRepository, Selectable
{

}
