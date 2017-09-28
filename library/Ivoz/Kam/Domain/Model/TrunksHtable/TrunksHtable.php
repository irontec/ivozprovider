<?php

namespace Ivoz\Kam\Domain\Model\TrunksHtable;

/**
 * TrunksHtable
 */
class TrunksHtable extends TrunksHtableAbstract implements TrunksHtableInterface
{
    use TrunksHtableTrait;

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

