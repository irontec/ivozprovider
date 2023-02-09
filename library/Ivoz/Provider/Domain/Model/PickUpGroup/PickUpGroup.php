<?php

namespace Ivoz\Provider\Domain\Model\PickUpGroup;

/**
 * PickUpGroup
 */
class PickUpGroup extends PickUpGroupAbstract implements PickUpGroupInterface
{
    use PickUpGroupTrait;

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
