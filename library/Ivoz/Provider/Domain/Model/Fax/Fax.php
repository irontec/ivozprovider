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

    public function setSendByEmail($sendByEmail)
    {
        $response = parent::setSendByEmail($sendByEmail);
        if ($this->getSendByEmail() == 0) {
            $this->setEmail(null);
        }
        return $response;
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

