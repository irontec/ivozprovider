<?php

namespace Ivoz\Provider\Domain\Model\QueueMember;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Persistence\ObjectRepository;

interface QueueMemberRepository extends ObjectRepository, Selectable
{
}
