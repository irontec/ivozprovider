<?php

namespace Ivoz\Provider\Domain\Model\ExternalCallFilterWhiteList;

/**
 * ExternalCallFilterWhiteList
 */
class ExternalCallFilterWhiteList extends ExternalCallFilterWhiteListAbstract implements ExternalCallFilterWhiteListInterface
{
    use ExternalCallFilterWhiteListTrait;

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
    public function getId(): ?int
    {
        return $this->id;
    }
}
