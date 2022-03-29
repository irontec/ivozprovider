<?php

namespace Ivoz\Provider\Domain\Model\VoicemailMessage;

/**
 * VoicemailMessage
 */
class VoicemailMessage extends VoicemailMessageAbstract implements VoicemailMessageInterface
{
    use VoicemailMessageTrait;

    /**
     * @codeCoverageIgnore
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
