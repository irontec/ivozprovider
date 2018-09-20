<?php

namespace Ivoz\Provider\Domain\Model\Administrator;

trait AdministratorSecurityTrait
{
    abstract public function getId();
    abstract public function getUsername();
    abstract public function getEmail();
    abstract public function getPass();
    abstract public function getActive();
    abstract public function getBrand();
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

        if (!is_null($brand)) {
            return [
                'ROLE_BRAND_ADMIN'
            ];
        }

        return [
            'ROLE_COMPANY_ADMIN'
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
