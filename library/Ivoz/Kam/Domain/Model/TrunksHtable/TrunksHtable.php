<?php

namespace Ivoz\Kam\Domain\Model\TrunksHtable;

/**
 * TrunksHtable
 */
class TrunksHtable extends TrunksHtableAbstract implements TrunksHtableInterface
{
    use TrunksHtableTrait;

    public function getChangeSet()
    {
        return parent::getChangeSet();
    }

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

