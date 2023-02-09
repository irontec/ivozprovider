<?php

namespace Ivoz\Provider\Domain\Model\TerminalManufacturer;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Persistence\ObjectRepository;

interface TerminalManufacturerRepository extends ObjectRepository, Selectable
{
}
