<?php

namespace Ivoz\Provider\Domain\Model\Commandlog;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Common\Persistence\ObjectRepository;

interface CommandlogRepository extends ObjectRepository, Selectable
{

}
