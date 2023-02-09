<?php

namespace Ivoz\Ast\Domain\Model\Voicemail;

/**
 * Voicemail
 */
class Voicemail extends VoicemailAbstract implements VoicemailInterface
{
    use VoicemailTrait;

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
