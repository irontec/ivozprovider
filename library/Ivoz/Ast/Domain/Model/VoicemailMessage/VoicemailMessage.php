<?php
declare(strict_types = 1);

namespace Ivoz\Ast\Domain\Model\VoicemailMessage;

class VoicemailMessage extends VoicemailMessageAbstract implements VoicemailMessageInterface
{
    use VoicemailMessageTrait;

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

