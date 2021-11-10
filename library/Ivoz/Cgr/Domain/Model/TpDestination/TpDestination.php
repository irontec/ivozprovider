<?php

namespace Ivoz\Cgr\Domain\Model\TpDestination;

/**
 * TpDestination
 */
class TpDestination extends TpDestinationAbstract implements TpDestinationInterface
{
    use TpDestinationTrait;

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
