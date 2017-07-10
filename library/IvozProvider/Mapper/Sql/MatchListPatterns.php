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
 * Data Mapper implementation for IvozProvider\Model\MatchListPatterns
 *
 * @package Mapper
 * @subpackage Sql
 * @author Luis Felipe Garcia
 */
namespace IvozProvider\Mapper\Sql;
class MatchListPatterns extends Raw\MatchListPatterns
{
    protected function _save(\IvozProvider\Model\Raw\MatchListPatterns $model,
            $recursive = false, $useTransaction = true, $transactionTag = null, $forceInsert = false
    )
    {
        $nullableFields = array(
            "number"        => "numberValue",
            "regexp"        => "regExp",
        );

        $patternType = $model->getType();
        foreach ($nullableFields as $type => $fieldName) {
            if ($patternType == $type) {
                continue;
            }
            $setter = "set".ucfirst($fieldName);
            $model->{$setter}(null);
        }
        return parent::_save($model, $recursive, $useTransaction, $transactionTag, $forceInsert);
    }
}
