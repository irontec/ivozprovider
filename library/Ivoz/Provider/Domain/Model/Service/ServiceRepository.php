<?php

namespace Ivoz\Provider\Domain\Model\Service;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Common\Persistence\ObjectRepository;

interface ServiceRepository extends ObjectRepository, Selectable
{

}
