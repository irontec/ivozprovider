<?php

namespace Ivoz\Provider\Domain\Model\Administrator;

use Symfony\Component\Security\Core\User\AdvancedUserInterface;

/**
 * Administrator
 */
class Administrator extends AdministratorAbstract implements AdministratorInterface, AdvancedUserInterface, \Serializable
{
    use AdministratorTrait, AdministratorSecurityTrait {
        AdministratorTrait::getRelPublicEntities insteadof AdministratorSecurityTrait;
    }

    /**
     * @return array
     */
    public function getChangeSet()
    {
        return parent::getChangeSet();
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

        $salt = substr(md5(random_int(0, mt_getrandmax()), false), 0, 22);
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

        return is_null($this->getCompany());
    }

    /**
     * @return bool
     * @deprecated dead code (apparently)
     */
    public function isCompanyAdmin()
    {
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

    protected function sanitizeValues()
    {
        if (!$this->getTimezone()) {
            $this->setTimezone(
                $this->getParentEntityTimezone()
            );
        }
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Timezone\TimezoneInterface | null
     */
    private function getParentEntityTimezone()
    {
        $company = $this->getCompany();
        if ($company) {
            return $company->getDefaultTimezone();
        }

        $brand = $this->getBrand();
        if ($brand) {
            return $brand->getDefaultTimezone();
        }

        return null;
    }
}
