<?php

namespace Ivoz\Provider\Domain\Model\Fax;

/**
 * Fax
 */
class Fax extends FaxAbstract implements FaxInterface
{
    use FaxTrait;

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

    /**
     * {@inheritDoc}
     */
    public function getOutgoingDdi()
    {
        if (!is_null($this->outgoingDdi)) {

            return parent::getOutgoingDdi();
        }

        return $this
            ->getCompany()
            ->getOutgoingDdi();
    }
}

