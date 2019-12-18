<?php

namespace Ivoz\Provider\Domain\Model\Country;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Common\Persistence\ObjectRepository;

interface CountryRepository extends ObjectRepository, Selectable
{

}
