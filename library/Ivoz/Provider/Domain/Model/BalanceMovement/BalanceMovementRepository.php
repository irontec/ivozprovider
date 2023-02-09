<?php

namespace Ivoz\Provider\Domain\Model\BalanceMovement;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Persistence\ObjectRepository;

interface BalanceMovementRepository extends ObjectRepository, Selectable
{
}
