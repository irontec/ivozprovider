<?php

namespace Ivoz\Provider\Domain\Model\User;

trait UserSecurityTrait
{
    abstract public function getEmail();
    abstract public function getPass();
    abstract public function getActive();

    /**
     * @see AdvancedUserInterface::getRoles()
     */
    public function getRoles()
    {
        return [
            'ROLE_COMPANY_USER'
        ];
    }

    /**
     * @see AdvancedUserInterface::getUsername()
     */
    public function getUsername()
    {
        return $this->getEmail();
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
