<?php

namespace Ivoz\Provider\Domain\Model\PublicEntity;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface PublicEntityRepository extends ObjectRepository, Selectable
{

}
