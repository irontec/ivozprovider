<?php

namespace Ivoz\Provider\Domain\Model\ApplicationServerSetRelApplicationServer;

/**
 * ApplicationServerSetRelApplicationServer
 */
class ApplicationServerSetRelApplicationServer extends ApplicationServerSetRelApplicationServerAbstract implements ApplicationServerSetRelApplicationServerInterface
{
    use ApplicationServerSetRelApplicationServerTrait;

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
