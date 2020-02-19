<?php

namespace Ivoz\Provider\Domain\Model\Administrator;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Common\Collections\ArrayCollection;

interface AdministratorInterface extends LoggableEntityInterface
{
    /**
     * @return array
     */
    public function getChangeSet();

    /**
     * @inheritdoc
     */
    public function setPass($pass = null);

    /**
     * @return bool
     */
    public function isSuperAdmin();

    /**
     * @return bool
     */
    public function isBrandAdmin();

    /**
     * @return bool
     * @deprecated dead code (apparently)
     */
    public function isCompanyAdmin();

    public function serialize();

    public function unserialize($serialized);

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername();

    /**
     * Get pass
     *
     * @return string
     */
    public function getPass();

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail();

    /**
     * Get active
     *
     * @return boolean
     */
    public function getActive();

    /**
     * Get restricted
     *
     * @return boolean
     */
    public function getRestricted();

    /**
     * Get name
     *
     * @return string | null
     */
    public function getName();

    /**
     * Get lastname
     *
     * @return string | null
     */
    public function getLastname();

    /**
     * Get brand
     *
     * @return \Ivoz\Provider\Domain\Model\Brand\BrandInterface | null
     */
    public function getBrand();

    /**
     * Get company
     *
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyInterface | null
     */
    public function getCompany();

    /**
     * Get timezone
     *
     * @return \Ivoz\Provider\Domain\Model\Timezone\TimezoneInterface | null
     */
    public function getTimezone();

    /**
     * Add relPublicEntity
     *
     * @param \Ivoz\Provider\Domain\Model\AdministratorRelPublicEntity\AdministratorRelPublicEntityInterface $relPublicEntity
     *
     * @return static
     */
    public function addRelPublicEntity(\Ivoz\Provider\Domain\Model\AdministratorRelPublicEntity\AdministratorRelPublicEntityInterface $relPublicEntity);

    /**
     * Remove relPublicEntity
     *
     * @param \Ivoz\Provider\Domain\Model\AdministratorRelPublicEntity\AdministratorRelPublicEntityInterface $relPublicEntity
     */
    public function removeRelPublicEntity(\Ivoz\Provider\Domain\Model\AdministratorRelPublicEntity\AdministratorRelPublicEntityInterface $relPublicEntity);

    /**
     * Replace relPublicEntities
     *
     * @param ArrayCollection $relPublicEntities of Ivoz\Provider\Domain\Model\AdministratorRelPublicEntity\AdministratorRelPublicEntityInterface
     * @return static
     */
    public function replaceRelPublicEntities(ArrayCollection $relPublicEntities);

    /**
     * Get relPublicEntities
     * @param Criteria | null $criteria
     * @return \Ivoz\Provider\Domain\Model\AdministratorRelPublicEntity\AdministratorRelPublicEntityInterface[]
     */
    public function getRelPublicEntities(\Doctrine\Common\Collections\Criteria $criteria = null);

    /**
     * @see AdvancedUserInterface::getRoles()
     */
    public function getRoles();

    /**
     * @see AdvancedUserInterface::getPassword()
     */
    public function getPassword();

    /**
     * @see AdvancedUserInterface::isAccountNonExpired()
     */
    public function isAccountNonExpired();

    /**
     * @see AdvancedUserInterface::isAccountNonLocked()
     */
    public function isAccountNonLocked();

    /**
     * @see AdvancedUserInterface::isCredentialsNonExpired()
     */
    public function isCredentialsNonExpired();

    /**
     * @see AdvancedUserInterface::isEnabled()
     */
    public function isEnabled();

    /**
     * @see AdvancedUserInterface::getSalt()
     */
    public function getSalt();

    /**
     * @see AdvancedUserInterface::eraseCredentials()
     */
    public function eraseCredentials();
}
