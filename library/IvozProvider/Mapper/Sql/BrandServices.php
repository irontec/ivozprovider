<?php

/**
 * Application Model Mapper
 *
 * @package Mapper
 * @subpackage Sql
 * @author Luis Felipe Garcia
 * @copyright ZF model generator
 * @license http://framework.zend.com/license/new-bsd     New BSD License
 */

/**
 * Data Mapper implementation for IvozProvider\Model\BrandServices
 *
 * @package Mapper
 * @subpackage Sql
 * @author Luis Felipe Garcia
 */
namespace IvozProvider\Mapper\Sql;
class BrandServices extends Raw\BrandServices
{
    public function delete(\IvozProvider\Model\Raw\ModelAbstract $model)
    {
        $companiesMapper = new \IvozProvider\Mapper\Sql\Companies;
        $companies =  $companiesMapper->fetchAll();

        // Foreach Company in Service Brand
        foreach ($companies as $company) {
            // Find Company Services with the same Service
            $companyServices = $company->getCompanyServices("serviceId = ". $model->getServiceId());
            foreach ($companyServices as $companyService) {
                // Delete custom company service code
                $companyService->delete();
            }
        }
        // Delete current model
        return parent::delete($model);
    }
}
