<?php

namespace Ivoz\Provider\Domain\Model\Ddi;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Persistence\ObjectRepository;

interface DdiRepository extends ObjectRepository, Selectable
{
    /**
     * @param string $ddiE164
     * @return DdiInterface | null
     */
    public function findOneByDdiE164($ddiE164);

    /**
     * @return \Ivoz\Provider\Domain\Model\Ddi\DdiInterface | null
     */
    public function findOneByDdiAndCountry(string $ddi, int $countryId);
}
