<?php

namespace Ivoz\Provider\Domain\Model\CallAcl;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Common\Persistence\ObjectRepository;

interface CallAclRepository extends ObjectRepository, Selectable
{

}
