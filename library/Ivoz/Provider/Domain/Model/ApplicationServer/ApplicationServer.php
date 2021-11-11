<?php

namespace Ivoz\Provider\Domain\Model\ApplicationServer;

/**
 * ApplicationServer
 */
class ApplicationServer extends ApplicationServerAbstract implements ApplicationServerInterface
{
    use ApplicationServerTrait;

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
}
