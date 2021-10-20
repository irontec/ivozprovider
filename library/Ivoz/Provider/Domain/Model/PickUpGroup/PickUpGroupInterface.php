<?php

namespace Ivoz\Provider\Domain\Model\PickUpGroup;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\PickUpRelUser\PickUpRelUserInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;

/**
* PickUpGroupInterface
*/
interface PickUpGroupInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet(): array;

    public function getName(): string;

    public function getCompany(): CompanyInterface;

    public function isInitialized(): bool;

    public function addRelUser(PickUpRelUserInterface $relUser): PickUpGroupInterface;

    public function removeRelUser(PickUpRelUserInterface $relUser): PickUpGroupInterface;

    public function replaceRelUsers(ArrayCollection $relUsers): PickUpGroupInterface;

    public function getRelUsers(?Criteria $criteria = null): array;
}
