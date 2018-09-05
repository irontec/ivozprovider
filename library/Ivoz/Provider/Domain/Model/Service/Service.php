<?php

namespace Ivoz\Provider\Domain\Model\Service;

use Assert\Assertion;

/**
 * Service
 */
class Service extends ServiceAbstract implements ServiceInterface
{
    use ServiceTrait;

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
    public function setDefaultCode($defaultCode)
    {
        Assertion::regex($defaultCode, '/^[#0-9*]+$/');
        return parent::setDefaultCode($defaultCode);
    }
}
