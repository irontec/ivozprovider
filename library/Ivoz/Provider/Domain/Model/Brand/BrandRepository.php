<?php

namespace Ivoz\Provider\Domain\Model\Brand;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Persistence\ObjectRepository;

interface BrandRepository extends ObjectRepository, Selectable
{
    /**
     * @return string[]
     */
    public function getNames();
}
