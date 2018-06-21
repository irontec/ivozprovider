<?php

namespace Ivoz\Provider\Domain\Model\MusicOnHold;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface MusicOnHoldRepository extends ObjectRepository, Selectable {}

