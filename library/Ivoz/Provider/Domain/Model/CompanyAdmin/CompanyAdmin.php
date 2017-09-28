<?php

namespace Ivoz\Provider\Domain\Model\CompanyAdmin;

/**
 * CompanyAdmin
 */
class CompanyAdmin extends CompanyAdminAbstract implements CompanyAdminInterface
{
    use CompanyAdminTrait;

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

