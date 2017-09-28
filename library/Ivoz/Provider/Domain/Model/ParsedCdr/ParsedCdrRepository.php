<?php

namespace Ivoz\Provider\Domain\Model\ParsedCdr;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface ParsedCdrRepository extends ObjectRepository, Selectable {}

