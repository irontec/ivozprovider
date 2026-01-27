<?php

namespace Ivoz\Provider\Domain\Model\ConferenceRoom;

use Ivoz\Provider\Domain\Model\Company\CompanyInterface;

/**
 * ConferenceRoom
 */
class ConferenceRoom extends ConferenceRoomAbstract implements ConferenceRoomInterface
{
    use ConferenceRoomTrait;

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
            "%s [%s]",
            $this->getName(),
            parent::__toString()
        );
    }

    /**
     * @return void
     * @throws \Exception
     */
    protected function sanitizeValues(): void
    {
        if (!$this->getPinProtected()) {
            $this->setPinCode(null);
        }
    }

    protected function setCompany(CompanyInterface $company): static
    {
        if ($company->getType() !== CompanyInterface::TYPE_VPBX) {
            throw new \DomainException('ConferenceRoom can only be associated with vpbx companies');
        }

        return parent::setCompany($company);
    }
}
