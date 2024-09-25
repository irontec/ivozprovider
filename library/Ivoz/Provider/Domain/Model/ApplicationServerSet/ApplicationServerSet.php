<?php

namespace Ivoz\Provider\Domain\Model\ApplicationServerSet;

/**
 * ApplicationServerSet
 */
class ApplicationServerSet extends ApplicationServerSetAbstract implements ApplicationServerSetInterface
{
    use ApplicationServerSetTrait;

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
     */
    public function getId(): ?int
    {
        return $this->id;
    }
}
