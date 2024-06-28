<?php

namespace Ivoz\Provider\Domain\Model\FaxesRelUser;

/**
 * FaxesRelUser
 */
class FaxesRelUser extends FaxesRelUserAbstract implements FaxesRelUserInterface
{
    use FaxesRelUserTrait;

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
     */
    public function getId(): ?int
    {
        return $this->id;
    }
}
