<?php

namespace Ivoz\Cgr\Domain\Model\TpCdr;

/**
 * TpCdr
 */
class TpCdr extends TpCdrAbstract implements TpCdrInterface
{
    use TpCdrTrait;

    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }


}

