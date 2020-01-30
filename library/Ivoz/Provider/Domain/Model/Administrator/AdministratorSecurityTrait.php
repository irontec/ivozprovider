<?php

namespace Ivoz\Provider\Domain\Model\Administrator;

use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;

trait AdministratorSecurityTrait
{
    abstract public function getId();

    /**
     * @return string
     */
    abstract public function getUsername();

    /**
     * @return string
     */
    abstract public function getEmail();

    /**
     * @return string
     */
    abstract public function getPass();

    /**
     * @return boolean
     */
    abstract public function getActive();

    /**
     * @return BrandInterface | null
     */
    abstract public function getBrand();

    /**
     * @return CompanyInterface | null
     */
    abstract public function getCompany();

    /**
     * @see AdvancedUserInterface::getRoles()
     */
    public function getRoles()
    {
        $brand = $this->getBrand();
        $company = $this->getCompany();

        if (is_null($brand) && is_null($company)) {
            return [
                'ROLE_SUPER_ADMIN'
            ];
        }

        if (!is_null($company)) {
            return [
                'ROLE_COMPANY_ADMIN'
            ];
        }

        return [
            'ROLE_BRAND_ADMIN'
        ];
    }

    /**
     * @see AdvancedUserInterface::getPassword()
     */
    public function getPassword()
    {
        return $this->getPass();
    }

    /**
     * @see AdvancedUserInterface::isAccountNonExpired()
     */
    public function isAccountNonExpired()
    {
        return true;
    }

    /**
     * @see AdvancedUserInterface::isAccountNonLocked()
     */
    public function isAccountNonLocked()
    {
        return true;
    }

    /**
     * @see AdvancedUserInterface::isCredentialsNonExpired()
     */
    public function isCredentialsNonExpired()
    {
        return true;
    }

    /**
     * @see AdvancedUserInterface::isEnabled()
     */
    public function isEnabled()
    {
        $isInnerGlobalAdmin = ($this->getId() === 0);
        if ($isInnerGlobalAdmin) {
            return true;
        }

        return $this->getActive();
    }

    /**
     * @see AdvancedUserInterface::getSalt()
     */
    public function getSalt()
    {
        return substr($this->getPassword(), 0, 29);
    }

    /**
     * @see AdvancedUserInterface::eraseCredentials()
     */
    public function eraseCredentials()
    {
    }
}
