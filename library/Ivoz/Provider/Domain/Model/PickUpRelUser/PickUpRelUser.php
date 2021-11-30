<?php

namespace Ivoz\Provider\Domain\Model\PickUpRelUser;

/**
 * PickUpRelUser
 */
class PickUpRelUser extends PickUpRelUserAbstract implements PickUpRelUserInterface
{
    use PickUpRelUserTrait;

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
