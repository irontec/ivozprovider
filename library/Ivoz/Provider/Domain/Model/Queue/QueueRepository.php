<?php

namespace Ivoz\Provider\Domain\Model\Queue;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Common\Persistence\ObjectRepository;

interface QueueRepository extends ObjectRepository, Selectable
{

}
