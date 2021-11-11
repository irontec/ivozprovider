<?php

namespace Ivoz\Provider\Domain\Model\ExternalCallFilterBlackList;

/**
 * ExternalCallFilterBlackList
 */
class ExternalCallFilterBlackList extends ExternalCallFilterBlackListAbstract implements ExternalCallFilterBlackListInterface
{
    use ExternalCallFilterBlackListTrait;

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
