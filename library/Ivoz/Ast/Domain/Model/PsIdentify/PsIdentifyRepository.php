<?php

namespace Ivoz\Ast\Domain\Model\PsIdentify;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Persistence\ObjectRepository;

interface PsIdentifyRepository extends ObjectRepository, Selectable
{
}
