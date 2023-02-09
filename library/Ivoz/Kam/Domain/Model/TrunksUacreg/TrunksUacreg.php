<?php

namespace Ivoz\Kam\Domain\Model\TrunksUacreg;

use Assert\Assertion;

/**
 * TrunksUacreg
 */
class TrunksUacreg extends TrunksUacregAbstract implements TrunksUacregInterface
{
    use TrunksUacregTrait;

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

    protected function sanitizeValues(): void
    {
        if (empty($this->getAuthUsername())) {
            $this->setAuthUsername($this->getRUsername());
        }

        if (!$this->getAuthProxy()) {
            $this->setAuthProxy('sip:' . $this->getRDomain());
        }
    }

    /**
     * {@inheritDoc}
     */
    public function setAuthProxy(string $authProxy): static
    {
        if (!empty($authProxy)) {
            Assertion::regex($authProxy, '/^sip:.+$|^sips:.+$/');
        }

        return parent::setAuthProxy($authProxy);
    }

    /**
     * @inheritdoc
     */
    public function setLUuid(string $lUuid): static
    {
        if (empty($lUuid)) {
            $lUuid = (string)round(microtime(true) * 1000);
        }

        return parent::setLUuid($lUuid);
    }
}
