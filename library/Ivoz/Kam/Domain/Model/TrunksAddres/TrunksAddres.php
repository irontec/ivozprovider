<?php

namespace Ivoz\Kam\Domain\Model\TrunksAddres;

/**
 * TrunksAddres
 */
class TrunksAddres extends TrunksAddresAbstract implements TrunksAddresInterface
{
    use TrunksAddresTrait;

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

