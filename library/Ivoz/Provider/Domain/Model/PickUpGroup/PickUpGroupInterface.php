<?php

namespace Ivoz\Provider\Domain\Model\PickUpGroup;

use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\PickUpRelUser\PickUpRelUserInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;

/**
* PickUpGroupInterface
*/
interface PickUpGroupInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * Get name
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Get company
     *
     * @return CompanyInterface
     */
    public function getCompany(): CompanyInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

    /**
     * Add relUser
     *
     * @param PickUpRelUserInterface $relUser
     *
     * @return static
     */
    public function addRelUser(PickUpRelUserInterface $relUser): PickUpGroupInterface;

    /**
     * Remove relUser
     *
     * @param PickUpRelUserInterface $relUser
     *
     * @return static
     */
    public function removeRelUser(PickUpRelUserInterface $relUser): PickUpGroupInterface;

    /**
     * Replace relUsers
     *
     * @param ArrayCollection $relUsers of PickUpRelUserInterface
     *
     * @return static
     */
    public function replaceRelUsers(ArrayCollection $relUsers): PickUpGroupInterface;

    /**
     * Get relUsers
     * @param Criteria | null $criteria
     * @return PickUpRelUserInterface[]
     */
    public function getRelUsers(?Criteria $criteria = null): array;

}
