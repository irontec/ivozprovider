<?php

namespace Ivoz\Cgr\Domain\Model\TpCdr;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface TpCdrRepository extends ObjectRepository, Selectable
{
    /**
     * @param string $originId
     * @return TpCdrInterface | null
     */
    public function getByOriginId(string $originId);


    /**
     * @param string $cgrid
     * @return TpCdrInterface | null
     */
    public function getDefaultRunByCgrid(string $cgrid);

    /**
     * @param string $cgrid
     * @return TpCdrInterface | null
     */
    public function getCarrierRunByCgrid(string $cgrid);
}
