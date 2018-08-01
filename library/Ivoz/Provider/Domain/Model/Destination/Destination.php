<?php

namespace Ivoz\Provider\Domain\Model\Destination;

/**
 * Destination
 */
class Destination extends DestinationAbstract implements DestinationInterface
{
    use DestinationTrait;

    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet()
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
     * @return string
     */
    public function getCgrTag()
    {
        return sprintf(
            "dst%d",
            $this->getId()
        );
    }
}

