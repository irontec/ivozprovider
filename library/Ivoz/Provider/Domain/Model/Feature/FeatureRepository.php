<?php

namespace Ivoz\Provider\Domain\Model\Feature;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface FeatureRepository extends ObjectRepository, Selectable {}

