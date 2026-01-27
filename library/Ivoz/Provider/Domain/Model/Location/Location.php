<?php

namespace Ivoz\Provider\Domain\Model\Location;

use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\User\UserInterface;

/**
 * Location
 */
class Location extends LocationAbstract implements LocationInterface
{
    use LocationTrait {
        addUser as traitAddUser;
    }

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

    public function addUser(UserInterface $user): LocationInterface
    {
        $user->setUseDefaultLocation(false);
        return $this->traitAddUser($user);
    }

    protected function setCompany(CompanyInterface $company): static
    {
        if ($company->getType() !== CompanyInterface::TYPE_VPBX) {
            throw new \DomainException('Location can only be associated with vpbx companies');
        }

        return parent::setCompany($company);
    }
}
