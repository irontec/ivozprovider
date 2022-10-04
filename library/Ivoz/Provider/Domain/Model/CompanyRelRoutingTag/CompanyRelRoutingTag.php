<?php

namespace Ivoz\Provider\Domain\Model\CompanyRelRoutingTag;

use Ivoz\Provider\Domain\Model\Company\CompanyInterface;

/**
 * CompanyRelRoutingTag
 * @codeCoverageIgnore
 */
class CompanyRelRoutingTag extends CompanyRelRoutingTagAbstract implements CompanyRelRoutingTagInterface
{
    use CompanyRelRoutingTagTrait;

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
}
