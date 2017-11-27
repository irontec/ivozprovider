<?php

namespace Ivoz\Provider\Domain\Model\CompanyService;

use Assert\Assertion;

/**
 * CompanyService
 */
class CompanyService extends CompanyServiceAbstract implements CompanyServiceInterface
{
    use CompanyServiceTrait;

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
    public function setCode($code)
    {
        Assertion::regex($code, '/^[#0-9*]+$/');
        return parent::setCode($code);
    }
}

