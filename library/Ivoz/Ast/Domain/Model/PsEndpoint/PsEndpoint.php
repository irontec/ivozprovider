<?php

namespace Ivoz\Ast\Domain\Model\PsEndpoint;

/**
 * PsEndpoint
 */
class PsEndpoint extends PsEndpointAbstract implements PsEndpointInterface
{
    use PsEndpointTrait;

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
