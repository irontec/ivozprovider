<?php

namespace Ivoz\Provider\Domain\Model\Administrator;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

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
     * @return \Ivoz\Provider\Domain\Model\Timezone\TimezoneInterface | null
     */
    public function getTimezone();

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
     * Set brand
     *
     * @param \Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand
     *
     * @return self
     */
    public function setBrand(\Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand = null);

    /**
     * Get brand
     *
     * @return \Ivoz\Provider\Domain\Model\Brand\BrandInterface | null
     */
    public function getBrand();

    /**
     * Set company
     *
     * @param \Ivoz\Provider\Domain\Model\Company\CompanyInterface $company
     *
     * @return self
     */
    public function setCompany(\Ivoz\Provider\Domain\Model\Company\CompanyInterface $company = null);

    /**
     * Get company
     *
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyInterface | null
     */
    public function getCompany();

    /**
     * Set timezone
     *
     * @param \Ivoz\Provider\Domain\Model\Timezone\TimezoneInterface $timezone
     *
     * @return self
     */
    public function setTimezone(\Ivoz\Provider\Domain\Model\Timezone\TimezoneInterface $timezone = null);

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
