<?php

namespace Ivoz\Provider\Domain\Model\Currency;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface CurrencyRepository extends ObjectRepository, Selectable
{

}
