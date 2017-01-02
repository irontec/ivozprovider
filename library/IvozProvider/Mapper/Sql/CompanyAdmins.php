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
 * Data Mapper implementation for IvozProvider\Model\CompanyAdmins
 *
 * @package Mapper
 * @subpackage Sql
 * @author Luis Felipe Garcia
 */
namespace IvozProvider\Mapper\Sql;
class CompanyAdmins extends Raw\CompanyAdmins
{

    protected function _save(\IvozProvider\Model\Raw\CompanyAdmins $model,
        $recursive = false, $useTransaction = true, $transactionTag = null, $forceInsert = false
    )
    {
        $isNew = !$model->getPrimaryKey();

        if ($isNew) {
            $user = $this->findOneByField("username", $model->getUsername(), "brandId", $model->getCompany()->getBrandId());
            if (!is_null($user)) {
                $error_msg = sprintf ("Username '%s' is already used in company '%s'", $model->getUsername(), $user->getCompany()->getName());
                throw new \Exception($error_msg);
            }
        }

        $response = parent::_save($model, $recursive, $useTransaction, $transactionTag, $forceInsert);
        return $response;
    }
}
