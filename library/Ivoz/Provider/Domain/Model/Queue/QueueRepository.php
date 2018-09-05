<?php

namespace Ivoz\Provider\Domain\Model\Queue;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface QueueRepository extends ObjectRepository, Selectable
{

}
