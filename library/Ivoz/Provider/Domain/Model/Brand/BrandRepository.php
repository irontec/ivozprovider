<?php

namespace Ivoz\Provider\Domain\Model\Brand;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Common\Persistence\ObjectRepository;

interface BrandRepository extends ObjectRepository, Selectable
{

}
