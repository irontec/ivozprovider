<?php

namespace Ivoz\Provider\Domain\Model\MediaRelaySet;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface MediaRelaySetRepository extends ObjectRepository, Selectable {}

