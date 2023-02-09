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
     * @return array<string, mixed>
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
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Return string representation of this entity
     * @return string
     */
    public function __toString(): string
    {
        return sprintf(
            "%s [%s]",
            $this->getService()->getName()->getEn(),
            parent::__toString()
        );
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
