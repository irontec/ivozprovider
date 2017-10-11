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
 * Data Mapper implementation for IvozProvider\Model\KamTrunksDialplan
 *
 * @package Mapper
 * @subpackage Sql
 * @author Luis Felipe Garcia
 */
namespace IvozProvider\Mapper\Sql;

use IvozProvider\Gearmand\Jobs\Xmlrpc;
class KamTrunksDialplan extends Raw\KamTrunksDialplan
{
    protected function _save(\IvozProvider\Model\Raw\KamTrunksDialplan $model,
            $recursive = false, $useTransaction = true, $transactionTag = null, $forceInsert = false
    ) {
        $front = \Zend_Controller_Front::getInstance();
        $screen = $front->getRequest()->getParam("screen");
        switch ($screen) {
            case "kamTrunksDialplan_caller_inNew_screen":
                $parentField = "CallerIn";
                break;
            case "kamTrunksDialplan_caller_outNew_screen":
                $parentField = "CallerOut";
                break;
            case "kamTrunksDialplan_callee_inNew_screen":
                $parentField = "CalleeIn";
                break;
            case "kamTrunksDialplan_callee_outNew_screen":
                $parentField = "CalleeOut";
                break;
            case "kamTrunksDialplanEdit_screen":
                $parentField = null;
                break;
            default:
                $parentField = null;
                break;
        }

        if (!is_null($parentField)) {
            $getter =  "get".$parentField;
            $parentModel = $model->getTransformationRulesetGroupsTrunks();
            $dpid = $parentModel->{$getter}();
            if (is_null($dpid)) {
                $kamTrunksDialplanMapper = new \IvozProvider\Mapper\Sql\KamTrunksDialplan();
                $maxDpiModel = $kamTrunksDialplanMapper->fetchOne(null, "dpid desc");
                $dpid = 1;
                if (!is_null($maxDpiModel)) {
                    $dpid = $maxDpiModel->getDpid()+1;
                }
            }
            $model->setDpid($dpid);
        }

        $model->setSubstExp($model->getMatchExp());

        $pk = parent::_save($model, $recursive, $useTransaction, $transactionTag, $forceInsert);

        if (!is_null($parentField)) {
            $setter =  "set".$parentField;
            $parentModel->{$setter}($dpid)->save();
        }

        try {
            $this->_sendXmlRcp();
        } catch (\Exception $e) {
            $message = $e->getMessage()."<p>Kam Trunks dialplan may have been saved.</p>";
            throw new \Exception($message);
        }

        return $pk;
    }

    public function delete(\IvozProvider\Model\Raw\ModelAbstract $model)
    {
        $mapper = $model->getMapper();
        $dpid = $model->getDpid();
        $transformationRulesetGroupsTrunksId = $model->getTransformationRulesetGroupsTrunksId();

        $result = parent::delete($model);

        $conditions = array();
        $conditions[] = "dpid = ".$dpid;
        $conditions[] = "transformationRulesetGroupsTrunksId = '".$transformationRulesetGroupsTrunksId."'";

        $nRemaining = $mapper->countByQuery(implode(" AND ", $conditions));

        if ($nRemaining == 0) {
            $parentModel = $model->getTransformationRulesetGroupsTrunks();
            $targetFields = array(
                    "callerIn",
                    "callerOut",
                    "calleeIn",
                    "calleeOut"
            );
            foreach ($targetFields as $field) {
                $getter = "get".ucfirst($field);
                $setter = "set".ucfirst($field);
                if ($parentModel->{$getter}() == $dpid) {
                    $parentModel->{$setter}(null);
                }
            }
            $parentModel->save();
        }

        try {
            $this->_sendXmlRcp();
        } catch (\Exception $e) {
            $message = $e->getMessage()."<p>Kam Trunks dialplan may have been deleted.</p>";
            throw new \Exception($message);
        }

        return $result;
    }

    protected function _sendXmlRcp()
    {
        $proxyServers = array(
            'proxytrunks' => "dialplan.reload"
        );
        $xmlrpcJob = new Xmlrpc();
        $xmlrpcJob->setProxyServers($proxyServers);
        $xmlrpcJob->send();
    }
}
