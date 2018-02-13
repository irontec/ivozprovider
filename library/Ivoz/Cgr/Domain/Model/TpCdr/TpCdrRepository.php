<?php

namespace Ivoz\Cgr\Domain\Model\TpCdr;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface TpCdrRepository extends ObjectRepository, Selectable
{
    /**
     * @param string $cgrid
     * @return int
     */
    public function getOneByCgrid(string $cgrid);
}

