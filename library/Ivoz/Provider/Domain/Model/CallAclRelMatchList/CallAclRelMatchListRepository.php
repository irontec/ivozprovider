<?php

namespace Ivoz\Provider\Domain\Model\CallAclRelMatchList;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface CallAclRelMatchListRepository extends ObjectRepository, Selectable {}

