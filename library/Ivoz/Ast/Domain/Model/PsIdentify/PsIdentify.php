<?php

namespace Ivoz\Ast\Domain\Model\PsIdentify;

/**
 * PsIdentify
 */
class PsIdentify extends PsIdentifyAbstract implements PsIdentifyInterface
{
    use PsIdentifyTrait;

    public const MATCH_HEADER = 'X-Info-Endpoint: ';

    /**
     * @codeCoverageIgnore
     * @return array
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

    public function setMatchHeader(?string $matchHeader = null): static
    {
        return parent::setMatchHeader(self::MATCH_HEADER . $matchHeader);
    }
}
