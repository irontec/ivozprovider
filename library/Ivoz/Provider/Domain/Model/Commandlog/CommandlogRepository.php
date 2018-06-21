<?php

namespace Ivoz\Provider\Domain\Model\Commandlog;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface CommandlogRepository extends  ObjectRepository, Selectable
{

}
