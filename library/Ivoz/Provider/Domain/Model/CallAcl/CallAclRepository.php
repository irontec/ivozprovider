<?php

namespace Ivoz\Provider\Domain\Model\CallAcl;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface CallAclRepository extends ObjectRepository, Selectable
{

}
