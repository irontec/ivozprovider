<?php

namespace Ivoz\Provider\Domain\Model\BalanceNotification;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface BalanceNotificationRepository extends ObjectRepository, Selectable {}

