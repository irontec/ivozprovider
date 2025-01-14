<?php

namespace Ivoz\Provider\Domain\Model\ApplicationServerSet;

use Ivoz\Core\Domain\Assert\Assertion;

/**
 * ApplicationServerSet
 */
class ApplicationServerSet extends ApplicationServerSetAbstract implements ApplicationServerSetInterface
{
    use ApplicationServerSetTrait;

    public const DEFAULT_APPLICATION_SERVER_SET = 0;

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

    protected function sanitizeValues(): void
    {
        $this->sanitizeAvoidEmptyApplicationServers();
    }

    /**
     * @return void
     * @throws \Assert\AssertionFailedException
     */
    protected function sanitizeAvoidEmptyApplicationServers(): void
    {
        if ($this->isNew()) {
            return;
        }

        $relApplicationServerSets = $this->getRelApplicationServers();

        Assertion::notEmpty(
            $relApplicationServerSets
        );
    }
}
