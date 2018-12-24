<?php

namespace Ivoz\Provider\Domain\Model\Administrator;

use Symfony\Component\Security\Core\User\AdvancedUserInterface;

/**
 * Administrator
 */
class Administrator extends AdministratorAbstract implements AdministratorInterface, AdvancedUserInterface, \Serializable
{
    use AdministratorTrait;
    use AdministratorSecurityTrait;

    /**
     * @return array
     */
    public function getChangeSet()
    {
        $changeSet = parent::getChangeSet();
        if (isset($changeSet['pass'])) {
            $changeSet['pass'] = '****';
        }

        return $changeSet;
    }

    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function setPass($pass = null)
    {
        if ($pass === $this->getPass()) {
            return $this;
        }

        $salt = substr(md5(mt_rand(), false), 0, 22);
        $cryptPass = crypt(
            $pass,
            '$2a$08$' . $salt . '$' . $salt . '$'
        );

        return parent::setPass($cryptPass);
    }

    /**
     * @return bool
     */
    public function isSuperAdmin()
    {
        $nullBrand = is_null($this->getBrand());
        $nullCompany = is_null($this->getCompany());

        return $nullBrand && $nullCompany;
    }

    /**
     * @return bool
     */
    public function isBrandAdmin()
    {
        if ($this->isSuperAdmin()) {
            return true;
        }

        return !is_null($this->getBrand());
    }

    /**
     * @return bool
     * @deprecated dead code (apparently)
     */
    public function isCompanyAdmin()
    {
        if ($this->isBrandAdmin()) {
            return true;
        }

        return !is_null($this->getCompany());
    }

    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->pass,
            $this->email,
            $this->active
        ));
    }

    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->pass,
            $this->email,
            $this->active
            ) = unserialize($serialized);
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Timezone\TimezoneInterface | null
     */
    public function getTimezone()
    {
        $timeZone = parent::getTimezone();
        if (!empty($timeZone)) {
            return $timeZone;
        }

        if ($this->getCompany()) {
            return $this
                ->getCompany()
                ->getDefaultTimezone();
        }

        return null;
    }
}
