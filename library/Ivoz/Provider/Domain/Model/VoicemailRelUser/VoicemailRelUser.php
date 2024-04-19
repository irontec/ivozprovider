<?php

namespace Ivoz\Provider\Domain\Model\VoicemailRelUser;

/**
 * VoicemailRelUser
 */
class VoicemailRelUser extends VoicemailRelUserAbstract implements VoicemailRelUserInterface
{
    use VoicemailRelUserTrait;

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
