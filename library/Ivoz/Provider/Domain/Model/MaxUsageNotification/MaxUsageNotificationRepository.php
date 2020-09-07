<?php

namespace Ivoz\Provider\Domain\Model\MaxUsageNotification;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface MaxUsageNotificationRepository extends ObjectRepository, Selectable
{

}
