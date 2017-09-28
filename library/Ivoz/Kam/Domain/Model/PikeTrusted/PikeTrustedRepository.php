<?php

namespace Ivoz\Kam\Domain\Model\PikeTrusted;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface PikeTrustedRepository extends ObjectRepository, Selectable {}

