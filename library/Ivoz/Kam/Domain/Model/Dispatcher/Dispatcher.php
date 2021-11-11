<?php

namespace Ivoz\Kam\Domain\Model\Dispatcher;

/**
 * Dispatcher
 */
class Dispatcher extends DispatcherAbstract implements DispatcherInterface
{
    use DispatcherTrait;

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
