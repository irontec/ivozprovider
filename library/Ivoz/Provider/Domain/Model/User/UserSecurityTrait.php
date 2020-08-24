<?php

namespace Ivoz\Provider\Domain\Model\User;

trait UserSecurityTrait
{
    abstract public function getEmail();
    abstract public function getPass();
    abstract public function getActive(): bool;

    /**
     * @see AdvancedUserInterface::getRoles()
     */
    public function getRoles(): array
    {
        return [
            'ROLE_COMPANY_USER'
        ];
    }

    /**
     * @see AdvancedUserInterface::getUsername()
     */
    public function getUsername(): string
    {
        return $this->getEmail();
    }

    /**
     * @see AdvancedUserInterface::getPassword()
     */
    public function getPassword(): string
    {
        return $this->getPass();
    }

    /**
     * @see AdvancedUserInterface::isAccountNonExpired()
     */
    public function isAccountNonExpired(): bool
    {
        return true;
    }

    /**
     * @see AdvancedUserInterface::isAccountNonLocked()
     */
    public function isAccountNonLocked(): bool
    {
        return true;
    }

    /**
     * @see AdvancedUserInterface::isCredentialsNonExpired()
     */
    public function isCredentialsNonExpired(): bool
    {
        return true;
    }

    /**
     * @see AdvancedUserInterface::isEnabled()
     */
    public function isEnabled(): bool
    {
        return $this->getActive();
    }

    /**
     * @see AdvancedUserInterface::getSalt()
     */
    public function getSalt(): string
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
