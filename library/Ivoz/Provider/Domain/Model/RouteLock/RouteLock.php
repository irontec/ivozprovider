<?php

namespace Ivoz\Provider\Domain\Model\RouteLock;

use Ivoz\Provider\Domain\Model\Company\CompanyInterface;

/**
 * RouteLock
 */
class RouteLock extends RouteLockAbstract implements RouteLockInterface
{
    use RouteLockTrait;

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
     * Return in current lock status is open
     *
     * @return boolean
     */
    public function isOpen()
    {
        return $this->getOpen() == '1';
    }

    /**
     * Return the DeviceName used to create Hints
     */
    public function getHintDeviceName(): string
    {
        return "Stasis:RouteLock" . $this->getId();
    }

    protected function setCompany(CompanyInterface $company): static
    {
        if ($company->getType() !== CompanyInterface::TYPE_VPBX) {
            throw new \DomainException('RouteLock can only be associated with vpbx companies');
        }

        return parent::setCompany($company);
    }
}
