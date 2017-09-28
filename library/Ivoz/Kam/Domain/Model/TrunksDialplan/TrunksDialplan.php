<?php

namespace Ivoz\Kam\Domain\Model\TrunksDialplan;

/**
 * TrunksDialplan
 */
class TrunksDialplan extends TrunksDialplanAbstract implements TrunksDialplanInterface
{
    use TrunksDialplanTrait;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}

