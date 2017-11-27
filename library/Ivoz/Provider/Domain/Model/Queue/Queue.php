<?php

namespace Ivoz\Provider\Domain\Model\Queue;

use Assert\Assertion;

/**
 * Queue
 */
class Queue extends QueueAbstract implements QueueInterface
{
    use QueueTrait;

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
    public function setName($name = null)
    {
        Assertion::regex($name, '/^[a-zA-Z0-9_-]+$/');
        return parent::setName($name);
    }

    public function getAstQueueName()
    {
        return sprintf("b%dc%dq%d_%s",
            $this->getCompany()->getBrand()->getId(),
            $this->getCompany()->getId(),
            $this->getId(),
            $this->getName()
        );

    }
    /**
     * Get the timeout numberValue in E.164 format when routing to 'number'
     *
     * @return string
     */
    public function getTimeoutNumberValueE164()
    {
        return
            $this->getTimeoutNumberCountry()->getCountryCode() .
            $this->getTimeoutNumberValue();
    }

    /**
     * Get the full numberValue in E.164 format when routing to 'number'
     *
     * @return string
     */
    public function getFullNumberValueE164()
    {
        return
            $this->getFullNumberCountry()->getCountryCode() .
            $this->getFullNumberValue();
    }
}

