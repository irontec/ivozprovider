<?php

namespace Ivoz\Provider\Domain\Model\ProxyUser;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface ProxyUserRepository extends ObjectRepository, Selectable
{

}
