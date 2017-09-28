<?php

namespace Ivoz\Provider\Domain\Model\TerminalManufacturer;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface TerminalManufacturerRepository extends ObjectRepository, Selectable {}

