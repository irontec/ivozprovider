<?php

namespace Ivoz\Provider\Domain\Model\PickUpGroup;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface PickUpGroupRepository extends ObjectRepository, Selectable {}

