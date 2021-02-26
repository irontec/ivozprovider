<?php

namespace Ivoz\Provider\Domain\Model\Destination;

use Assert\Assertion;

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
     * Validate prefix comes in E.164 format
     *
     * @inheritdoc
     */
    public function setPrefix(string $prefix): static
    {
        Assertion::regex($prefix, '/^\\+[0-9]+$/');

        return parent::setPrefix($prefix);
    }



    /**
     * @return string
     */
    public function getCgrTag()
    {
        return sprintf(
            "b%ddst%d",
            $this->getBrand()->getId(),
            $this->getId()
        );
    }
}
