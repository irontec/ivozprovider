<?php

namespace Ivoz\Provider\Domain\Model\CompanyAdmin;

/**
 * CompanyAdmin
 */
class CompanyAdmin extends CompanyAdminAbstract implements CompanyAdminInterface
{
    use CompanyAdminTrait;

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
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}

