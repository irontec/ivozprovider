<?php

namespace Ivoz\Kam\Domain\Model\TrunksUacreg;

/**
 * TrunksUacreg
 */
class TrunksUacreg extends TrunksUacregAbstract implements TrunksUacregInterface
{
    use TrunksUacregTrait;

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

