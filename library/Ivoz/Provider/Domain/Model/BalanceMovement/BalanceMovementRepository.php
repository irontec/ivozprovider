<?php

namespace Ivoz\Provider\Domain\Model\BalanceMovement;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface BalanceMovementRepository extends ObjectRepository, Selectable {}

