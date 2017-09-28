<?php

namespace Ivoz\Provider\Domain\Model\IvrCustomEntry;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface IvrCustomEntryRepository extends ObjectRepository, Selectable {}

