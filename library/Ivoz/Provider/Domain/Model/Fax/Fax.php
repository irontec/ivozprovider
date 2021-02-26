<?php

namespace Ivoz\Provider\Domain\Model\Fax;

use Ivoz\Provider\Domain\Model\Ddi\DdiInterface;

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
     * Return string representation of this entity
     * @return string
     */
    public function __toString()
    {
        return sprintf(
            "%s [fax%d]",
            $this->getName(),
            $this->getId()
        );
    }

    public function setSendByEmail(bool $sendByEmail): static
    {
        $response = parent::setSendByEmail($sendByEmail);
        if ($this->getSendByEmail() == 0) {
            $this->setEmail(null);
        }
        return $response;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Ddi\DdiInterface
     */
    public function getOutgoingDdi(): DdiInterface
    {
        if (!is_null($this->outgoingDdi)) {
            return parent::getOutgoingDdi();
        }

        return $this
            ->getCompany()
            ->getOutgoingDdi();
    }
}
