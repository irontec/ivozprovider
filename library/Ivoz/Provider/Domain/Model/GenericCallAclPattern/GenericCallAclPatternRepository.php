<?php

namespace Ivoz\Provider\Domain\Model\GenericCallAclPattern;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface GenericCallAclPatternRepository extends ObjectRepository, Selectable {}

