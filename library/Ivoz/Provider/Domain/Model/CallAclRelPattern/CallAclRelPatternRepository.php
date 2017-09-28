<?php

namespace Ivoz\Provider\Domain\Model\CallAclRelPattern;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface CallAclRelPatternRepository extends ObjectRepository, Selectable {}

