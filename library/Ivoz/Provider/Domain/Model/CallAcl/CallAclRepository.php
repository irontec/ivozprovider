<?php

namespace Ivoz\Provider\Domain\Model\CallAcl;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Persistence\ObjectRepository;

interface CallAclRepository extends ObjectRepository, Selectable
{

}
