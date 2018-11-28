<?php

namespace Ivoz\Provider\Domain\Model\Ddi;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface DdiRepository extends ObjectRepository, Selectable
{
    /**
     * @param $ddiE164
     * @return DdiInterface | null
     */
    public function findOneByDdiE164($ddiE164);
}
