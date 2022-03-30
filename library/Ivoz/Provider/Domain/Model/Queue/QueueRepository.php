<?php

namespace Ivoz\Provider\Domain\Model\Queue;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Persistence\ObjectRepository;

interface QueueRepository extends ObjectRepository, Selectable
{
}
