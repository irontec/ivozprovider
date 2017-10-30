<?php

namespace Ivoz\Kam\Domain\Model\Dispatcher;

/**
 * Dispatcher
 */
class Dispatcher extends DispatcherAbstract implements DispatcherInterface
{
    use DispatcherTrait;

    public function getChangeSet()
    {
        return parent::getChangeSet();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}

