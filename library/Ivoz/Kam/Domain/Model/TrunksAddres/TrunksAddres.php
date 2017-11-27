<?php

namespace Ivoz\Kam\Domain\Model\TrunksAddres;

/**
 * TrunksAddres
 */
class TrunksAddres extends TrunksAddresAbstract implements TrunksAddresInterface
{
    use TrunksAddresTrait;

    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet()
    {
        return parent::getChangeSet();
    }

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

