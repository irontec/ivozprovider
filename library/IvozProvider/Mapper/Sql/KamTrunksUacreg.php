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
 * Data Mapper implementation for IvozProvider\Model\KamTrunksUacreg
 *
 * @package Mapper
 * @subpackage Sql
 * @author Luis Felipe Garcia
 */
namespace IvozProvider\Mapper\Sql;

use IvozProvider\Gearmand\Jobs\Xmlrpcdelayedproxytrunks;
use IvozProvider\Gearmand\Jobs\Xmlrpcdelayedproxyusers;
class KamTrunksUacreg extends Raw\KamTrunksUacreg
{
    protected function _save(\IvozProvider\Model\Raw\KamTrunksUacreg $model,
            $recursive = false, $useTransaction = true, $transactionTag = null, $forceInsert = false
    )
    {
        if (empty($model->getAuthUsername())) {
            $model->setAuthUsername($model->getRUsername());
        }
        if (empty($model->getAuthProxy())) {
            $model->setAuthProxy('sip:'.$model->getRDomain());
        }

        // Multi-DDI support
        $multiDDI_is_enabled_in_new_item = !$model->getPrimaryKey() && $model->getMultiDdi(); # New item
        $multiDDI_has_been_enabled = $model->getPrimaryKey() && $model->hasChange('multiDDI') && $model->getMultiDdi(); # Existing item
        if ($multiDDI_has_been_enabled or $multiDDI_is_enabled_in_new_item) {
            $model->setLUuid(round(microtime(true) * 1000));
        }

        $response =  parent::_save($model, $recursive, $useTransaction, $transactionTag, $forceInsert);
        try {
            $this->_sendXmlRcp();
        } catch (\Exception $e) {
            $message = $e->getMessage()."<p>Sip registy may have been saved.</p>";
            throw new \Exception($message);
        }

        return $response;
    }

    public function delete(\IvozProvider\Model\Raw\ModelAbstract $model)
    {
        $response = parent::delete($model);
        try {
            $this->_sendXmlRcp();
        } catch (\Exception $e) {
            $message = $e->getMessage()."<p>Sip registy may have been deleted.</p>";
            throw new \Exception($message);
        }
        return $response;
    }

    protected function _sendXmlRcp()
    {
        $proxyServers = array(
                'proxytrunks' => "uac.reg_reload"
        );

        $xmlrpcJob = new Xmlrpcdelayedproxytrunks();
        $xmlrpcJob
            ->setProxyServers($proxyServers)
            ->setMapperName("KamTrunksUacreg")
            ->send();
    }
}
