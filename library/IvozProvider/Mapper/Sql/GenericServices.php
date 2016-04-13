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
 * Data Mapper implementation for IvozProvider\Model\GenericServices
 *
 * @package Mapper
 * @subpackage Sql
 * @author Luis Felipe Garcia
 */
namespace IvozProvider\Mapper\Sql;
class GenericServices extends Raw\GenericServices
{
    protected function _save(\IvozProvider\Model\Raw\GenericServices $model,
            $recursive = false, $useTransaction = true, $transactionTag = null, $forceInsert = false
    )
    {
        $isNew = is_null($model->getPrimaryKey());
        $result = parent::_save($model, $recursive, $useTransaction, $transactionTag, $forceInsert);
        if ($isNew) {
            $this->_propagateServices($model);
        }
        return $result;
    }

    public function delete(\IvozProvider\Model\Raw\ModelAbstract $model)
    {
        $result = parent::delete($model);
        $this->_unpropagateServices($model);
        return $result;
    }

    protected function _propagateServices(\IvozProvider\Model\Raw\GenericServices $model)
    {
        $brand = $model->getBrand();
        $companiesMapper = new \IvozProvider\Mapper\Sql\Companies();
        $companies = $companiesMapper->findByField("brandId", $brand->getPrimaryKey());
        foreach ($companies as $company) {
            $service = new \IvozProvider\Model\Services();
            $service
                ->setName($model->getName())
                ->setDescription($model->getDescription())
                ->setCode($model->getCode())
                ->setCompany($company)
                ->save();
        }
    }

    protected function _unpropagateServices(\IvozProvider\Model\Raw\GenericServices $model)
    {
        $brand = $model->getBrand();
        $companiesMapper = new \IvozProvider\Mapper\Sql\Companies();
        $companies = $companiesMapper->findByField("brandId", $brand->getPrimaryKey());
        foreach ($companies as $company) {
            $where = "name = '".$model->getName()."'";
            $services = $company->getServices($where);
            foreach ($services as $service) {
                $service->delete();
            }
        }
    }
}
