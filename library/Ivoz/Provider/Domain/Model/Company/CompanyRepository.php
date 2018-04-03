<?php

namespace Ivoz\Provider\Domain\Model\Company;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;
use Ivoz\Provider\Domain\Model\Administrator\AdministratorInterface;

interface CompanyRepository extends ObjectRepository, Selectable
{
    /**
     * @return array
     */
    public function getSupervisedCompanyIdsByAdmin(AdministratorInterface $admin);

    /**
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyInterface[]
     */
    public function getPrepaidCompanies();
}

