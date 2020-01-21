<?php

namespace Ivoz\Provider\Domain\Model\IvrEntry;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Common\Persistence\ObjectRepository;

interface IvrEntryRepository extends ObjectRepository, Selectable
{

}
