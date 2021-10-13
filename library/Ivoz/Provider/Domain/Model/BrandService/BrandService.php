<?php

namespace Ivoz\Provider\Domain\Model\BrandService;

use Assert\Assertion;

/**
 * BrandService
 */
class BrandService extends BrandServiceAbstract implements BrandServiceInterface
{
    use BrandServiceTrait;

    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet(): array
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
    public function setCode(string $code): static
    {
        Assertion::regex($code, '/^[#0-9*]+$/');
        return parent::setCode($code);
    }
}
