<?php

namespace Ivoz\Provider\Domain\Model\PeeringContract;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface PeeringContractRepository extends ObjectRepository, Selectable {}

