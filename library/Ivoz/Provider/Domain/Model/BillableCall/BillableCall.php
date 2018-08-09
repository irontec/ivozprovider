<?php

namespace Ivoz\Provider\Domain\Model\BillableCall;

/**
 * BillableCall
 */
class BillableCall extends BillableCallAbstract implements BillableCallInterface
{
    use BillableCallTrait;

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

