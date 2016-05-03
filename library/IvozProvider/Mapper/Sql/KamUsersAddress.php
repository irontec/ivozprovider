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
 * Data Mapper implementation for IvozProvider\Model\KamUsersAddress
 *
 * @package Mapper
 * @subpackage Sql
 * @author Luis Felipe Garcia
 */
namespace IvozProvider\Mapper\Sql;
use IvozProvider\Gearmand\Jobs\Xmlrpc;

class KamUsersAddress extends Raw\KamUsersAddress
{
    protected function _save(\IvozProvider\Model\Raw\KamUsersAddress $model,
        $recursive = false, $useTransaction = true, $transactionTag = null, $forceInsert = false
    )
    {
        list($ip, $mask) = explode('/', $model->getSourceAddress());

        // Validate IP
        if (!filter_var($ip, FILTER_VALIDATE_IP, array(FILTER_FLAG_IPV4))) {
            throw new \Exception("Invalid IP address, discarding value.", 70000);
        }

        // Validate mask
        if (is_null($mask)) {
            $mask = 32;
        } else {
            if (!is_numeric($mask) or $mask < 0 or $mask > 32) {
                throw new \Exception("Wrong mask, discarding value.", 70001);
            }
        }

        // Save validated values
        $model->setIpAddr($ip);
        $model->setMask($mask);

        $pk = parent::_save($model, true, $useTransaction, $transactionTag, $forceInsert);

        try {
            $this->_sendXmlRcp();
        } catch (\Exception $e) {
            $message = $e->getMessage()."<p>Authorized source may have been saved.</p>";
            throw new \Exception($message);
        }

        return $pk;
    }

    public function delete(\IvozProvider\Model\Raw\ModelAbstract $model)
    {
        $response = parent::delete($model);
        try {
            $this->_sendXmlRcp();
        } catch (\Exception $e) {
            $message = $e->getMessage()."<p>Authorized source may have been deleted.</p>";
            throw new \Exception($message);
        }
        return $response;
    }

    protected function _sendXmlRcp()
    {
        $proxyServers = array(
                'proxyusers' => "permissions.addressReload",
        );
        $xmlrpcJob = new Xmlrpc();
        $xmlrpcJob->setProxyServers($proxyServers);
        $xmlrpcJob->send();
    }
}
