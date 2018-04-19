<?php

namespace Ivoz\Kam\Domain\Model\Trusted;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface TrustedRepository extends ObjectRepository, Selectable {}

