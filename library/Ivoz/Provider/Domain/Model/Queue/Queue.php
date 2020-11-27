<?php

namespace Ivoz\Provider\Domain\Model\Queue;

use Assert\Assertion;
use Ivoz\Provider\Domain\Traits\RoutableTrait;

/**
 * Queue
 */
class Queue extends QueueAbstract implements QueueInterface
{
    use QueueTrait;
    use RoutableTrait;

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
    protected function sanitizeValues()
    {
        $this->sanitizeRouteValues('Timeout');
        $this->sanitizeRouteValues('Full');
    }


    /**
     * {@inheritDoc}
     */
    public function setName(?string $name = null): self
    {
        Assertion::regex($name, '/^[a-zA-Z0-9_-]+$/');
        return parent::setName($name);
    }

    public function getAstQueueName()
    {
        return sprintf(
            "b%dc%dq%d_%s",
            $this->getCompany()->getBrand()->getId(),
            $this->getCompany()->getId(),
            $this->getId(),
            $this->getName()
        );
    }

    /**
     * @return string
     */
    public function getTimeoutRouteType()
    {
        return $this->getTimeoutTargetType();
    }

    /**
     * Get the timeout numberValue in E.164 format when routing to 'number'
     *
     * @return string
     */
    public function getTimeoutNumberValueE164()
    {
        if (!$this->getTimeoutNumberCountry()) {
            return "";
        }

        return
            $this->getTimeoutNumberCountry()->getCountryCode() .
            $this->getTimeoutNumberValue();
    }

    /**
     * @return string
     */
    public function getFullRouteType()
    {
        return $this->getFullTargetType();
    }

    /**
     * Get the full numberValue in E.164 format when routing to 'number'
     *
     * @return string
     */
    public function getFullNumberValueE164()
    {
        if (!$this->getFullNumberCountry()) {
            return "";
        }

        return
            $this->getFullNumberCountry()->getCountryCode() .
            $this->getFullNumberValue();
    }

    public function setMaxWaitTime(?int $maxWaitTime = null): self
    {
        if ($maxWaitTime == 0) {
            $maxWaitTime = null;
        }

        return parent::setMaxWaitTime($maxWaitTime);
    }

    public function setMaxlen(?int $maxlen = null): self
    {
        if ($maxlen == 0) {
            $maxlen = null;
        }

        return parent::setMaxlen($maxlen);
    }
}
