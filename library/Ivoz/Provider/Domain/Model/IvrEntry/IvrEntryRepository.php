<?php

namespace Ivoz\Provider\Domain\Model\IvrEntry;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface IvrEntryRepository extends ObjectRepository, Selectable {}

