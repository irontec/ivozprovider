<?php

namespace Ivoz\Provider\Domain\Model\CallAclPattern;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface CallAclPatternRepository extends ObjectRepository, Selectable {}

