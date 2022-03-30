<?php

namespace Ivoz\Provider\Domain\Model\Feature;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Persistence\ObjectRepository;

interface FeatureRepository extends ObjectRepository, Selectable
{
}
