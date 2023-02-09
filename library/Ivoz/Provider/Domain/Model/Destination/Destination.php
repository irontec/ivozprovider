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
    public function getCgrTag(): string
    {
        return sprintf(
            "b%ddst%d",
            (int) $this->getBrand()->getId(),
            (int) $this->getId()
        );
    }
}
