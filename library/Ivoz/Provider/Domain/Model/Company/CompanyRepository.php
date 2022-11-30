<?php

namespace Ivoz\Provider\Domain\Model\Company;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Persistence\ObjectRepository;
use Ivoz\Provider\Domain\Model\Administrator\AdministratorInterface;

interface CompanyRepository extends ObjectRepository, Selectable
{
    /**
     * @param int $id
     * @return array of ids
     */
    public function findIdsByBrandId($id);

    /**
     * Used by brand API access controls
     * @inheritdoc
     * @see \Ivoz\Provider\Domain\Model\Company\CompanyRepository::getSupervisedCompanyIdsByAdmin
     */
    public function getSupervisedCompanyIdsByAdmin(AdministratorInterface $admin);

    /**
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyInterface[]
     */
    public function getPrepaidCompanies();

    /**
     * @param int $brandId | null
     * @return string[]
     */
    public function getNames($brandId = null);

    /**
     * @return int[]
     */
    public function getVpbxIdsByBrand(int $brandId);

    /**
     * @return int[]
     */
    public function getResidentialIdsByBrand(int $brandId);

    /**
     * @return int[]
     */
    public function getRetailIdsByBrand(int $brandId);

    public function findOneByDomain(string $domainUsers): ?CompanyInterface;
}
