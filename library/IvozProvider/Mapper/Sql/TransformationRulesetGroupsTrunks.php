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
 * Data Mapper implementation for IvozProvider\Model\TransformationRulesetGroupsTrunks
 *
 * @package Mapper
 * @subpackage Sql
 * @author Luis Felipe Garcia
 */
namespace IvozProvider\Mapper\Sql;

use IvozProvider\Gearmand\Jobs\Xmlrpc;
class TransformationRulesetGroupsTrunks extends Raw\TransformationRulesetGroupsTrunks
{
    protected function _save(\IvozProvider\Model\Raw\TransformationRulesetGroupsTrunks $model,
        $recursive = false, $useTransaction = true, $transactionTag = null, $forceInsert = false
    )
    {
        $isNew = !$model->getPrimaryKey();

        $response = parent::_save($model, $recursive, $useTransaction, $transactionTag, $forceInsert);

        if ($isNew && $model->getAutomatic()) {
            $cc = $model->getCountry()->getCallingCode();
            $length = $model->getNationalNumLength() - 1;
            $intcode = $model->getInternationalCode();

            // Calculate next dpid
            if (is_null($dpid)) {
                $dialplanMapper = new \IvozProvider\Mapper\Sql\KamTrunksDialplan();
                $maxDpiModel = $dialplanMapper->fetchOne(null, "dpid desc");
                $dpid = 1;
                if (!is_null($maxDpiModel)) {
                    $dpid = $maxDpiModel->getDpid()+1;
                }
            }

            // Callee Out rules
            $this->createDialplanRule($model, "^$cc([0-9]+)$", '\1', 1, 'E.164 to national', $dpid);
            $this->createDialplanRule($model, '^([0-9]+)$', $intcode . '\1', 2, 'E.164 to international', $dpid);
            $model->setCalleeOut($dpid);
            $dpid++;

            // Caller Out rules
            $this->createDialplanRule($model, "^$cc([0-9]+)$", '\1', 1, 'E.164 to national', $dpid);
            $this->createDialplanRule($model, '^([0-9]+)$', $intcode . '\1', 2, 'E.164 to international', $dpid);
            $model->setCallerOut($dpid);
            $dpid++;

            // Callee In rules
            $this->createDialplanRule($model, "^($intcode|\+)([1-9][0-9]+)$", '\2', 1, 'International to E.164', $dpid);
            $this->createDialplanRule($model, '^([1-9][0-9]{' . $length . '})$', $cc . '\1', 2, 'National to E.164', $dpid);
            $model->setCalleeIn($dpid);
            $dpid++;

            // Caller In rules
            $this->createDialplanRule($model, "^($intcode|\+)([1-9][0-9]+)$", '\2', 1, 'International to E.164', $dpid);
            $this->createDialplanRule($model, '^([1-9][0-9]{' . $length . '})$', $cc . '\1', 2, 'National to E.164', $dpid);
            $model->setCallerIn($dpid);

            $response = parent::_save($model, $recursive, $useTransaction, $transactionTag, $forceInsert);
        }

        return $response;
    }

    public function createDialplanRule($model, $matchExp, $replaceExp, $prio, $desc, $dpid=null)
    {
        $dialplan = new \IvozProvider\Model\KamTrunksDialplan();

        $dialplan->setDpid($dpid)
                 ->setPr($prio)
                 ->setMatchOp(1)
                 ->setMatchExp($matchExp)
                 ->setMatchLen(0)
                 ->setSubstExp($matchExp)
                 ->setReplExp($replaceExp)
                 ->setAttrs($desc)
                 ->setTransformationRulesetGroupsTrunksId($model->getPrimaryKey())
                 ->save();
    }

    public function delete(\IvozProvider\Model\Raw\ModelAbstract $model)
    {
        $result = parent::delete($model);
        try {
            $this->_sendXmlRcp();
        } catch (\Exception $e) {
            $message = $e->getMessage()."<p>Transformation ruleset groups trunks may have been deleted.</p>";
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
