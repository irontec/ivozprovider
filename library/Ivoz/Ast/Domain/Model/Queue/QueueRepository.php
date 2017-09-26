<?php

namespace Ivoz\Ast\Domain\Model\Queue;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface QueueRepository extends ObjectRepository, Selectable {}

