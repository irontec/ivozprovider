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
 * Data Mapper implementation for IvozProvider\Model\ApplicationServers
 *
 * @package Mapper
 * @subpackage Sql
 * @author Luis Felipe Garcia
 */
namespace IvozProvider\Mapper\Sql;

use IvozProvider\Gearmand\Jobs\Xmlrpc;
class ApplicationServers extends Raw\ApplicationServers
{
    protected function _save(\IvozProvider\Model\Raw\ApplicationServers $model,
            $recursive = false, $useTransaction = true, $transactionTag = null, $forceInsert = false
    )
    {
        $response = parent::_save($model, $recursive, $useTransaction, $transactionTag, $forceInsert);
        if ($response) {
            // Replicar IP del ApplicationServer en kam_dispatcher
            $kamDispatcherMapper = new \IvozProvider\Mapper\Sql\KamDispatcher();
            $kamDispatcher = $kamDispatcherMapper->findOneByField('applicationServerId', $response);
            if (is_null($kamDispatcher)) {
                $kamDispatcher = new \IvozProvider\Model\KamDispatcher();
                $kamDispatcher->setapplicationServerId($response);
            }
            $kamDispatcher->setSetid('1')
                          ->setDestination('sip:' . $model->getIp() . ":6060")
                          ->setAttrs('duid=' . $model->getId())
                          ->setDescription($model->getName())
                          ->save();
        }

        try {
            $this->_sendXmlRcp();
        } catch (\Exception $e) {
            $message = $e->getMessage()."<p>Application Server may have been saved.</p>";
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
            $message = $e->getMessage()."<p>Application Server may have been deleted.</p>";
            throw new \Exception($message);
        }
        return $response;
    }

    protected function _sendXmlRcp()
    {
        $proxyServers = array(
                'proxytrunks' => "dispatcher.reload",
                'proxyusers' => "dispatcher.reload",
        );
        $xmlrpcJob = new Xmlrpc();
        $xmlrpcJob->setProxyServers($proxyServers);
        $xmlrpcJob->send();
    }
}
