<?php

namespace Ivoz\Provider\Domain\Model\User;

use Symfony\Component\Security\Core\User\UserInterface;

trait UserSecurityTrait
{
    abstract public function getEmail();
    abstract public function getPass();
    abstract public function getActive(): bool;

    /**
     * @see UserInterface::getRoles()
     */
    public function getRoles(): array
    {
        return [
            'ROLE_COMPANY_USER'
        ];
    }

    /**
     * @see UserInterface::getUsername()
     */
    public function getUsername(): string
    {
        return $this->getEmail();
    }

    /**
     * @see UserInterface::getPassword()
     */
    public function getPassword(): string
    {
        return $this->getPass();
    }

    public function isEnabled(): bool
    {
        return $this->getActive();
    }

    /**
     * @see UserInterface::getSalt()
     */
    public function getSalt(): string
    {
        return substr($this->getPassword(), 0, 29);
    }

    /**
     * @see UserInterface::eraseCredentials()
     */
    public function eraseCredentials()
    {
    }
}
