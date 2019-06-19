<?php

namespace Ivoz\Provider\Domain\Model\RoutingTag;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface RoutingTagRepository extends ObjectRepository, Selectable
{
}
