<?php

namespace Ivoz\Provider\Domain\Model\FaxesInOut;

/**
 * FaxesInOut
 */
class FaxesInOut extends FaxesInOutAbstract implements FaxesInOutInterface
{
    use FaxesInOutTrait;

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

