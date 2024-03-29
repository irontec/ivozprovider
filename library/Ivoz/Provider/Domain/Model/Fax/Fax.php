<?php

namespace Ivoz\Provider\Domain\Model\Fax;

use Ivoz\Provider\Domain\Model\Ddi\DdiInterface;

/**
 * Fax
 */
class Fax extends FaxAbstract implements FaxInterface
{
    use FaxTrait;

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

    /**
     * Return string representation of this entity
     * @return string
     */
    public function __toString(): string
    {
        return sprintf(
            "%s [fax%d]",
            $this->getName(),
            (int) $this->getId()
        );
    }

    public function setSendByEmail(bool $sendByEmail): static
    {
        $response = parent::setSendByEmail($sendByEmail);
        if ($this->getSendByEmail() == 0) {
            $this->setEmail(null);
        }
        return $response;
    }

    /**
     * @return DdiInterface|null
     */
    public function getOutgoingDdi(): ?DdiInterface
    {
        if (!is_null($this->outgoingDdi)) {
            return parent::getOutgoingDdi();
        }

        return $this
            ->getCompany()
            ->getOutgoingDdi();
    }
}
