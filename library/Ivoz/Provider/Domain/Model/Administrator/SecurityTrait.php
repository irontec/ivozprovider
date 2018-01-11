<?php

namespace Ivoz\Provider\Domain\Model\Administrator;

use Symfony\Component\Security\Core\User\AdvancedUserInterface;

/**
 * UserSecurityTrait
 */
trait SecurityTrait
{
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

        return [
            'ROLE_ADMIN'
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
        return $this->getActive();
    }

    /**
     * @see AdvancedUserInterface::getSalt()
     */
    public function getSalt()
    {
        $hash = $this->getPassword();
        $hashParts = explode('$', trim($hash, '$'), 2);
        $salt = '';

        switch ($hashParts[0]) {
            case '1': //md5
                list(,,$salt,) = explode("$", $hash);
                $salt = '$1$' . $salt . '$';
                break;

            case '5': //sha
                list(,,$rounds,$salt,) = explode("$", $hash);
                $salt = '$5$' . $rounds . '$' . $salt . '$';
                break;

            case '2a': //blowfish
                $salt = substr($hash, 0, 29);
                break;
        }

        return $salt;
    }

    /**
     * @see AdvancedUserInterface::eraseCredentials()
     */
    public function eraseCredentials() {}
}

