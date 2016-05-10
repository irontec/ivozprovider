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
 * Data Mapper implementation for IvozProvider\Model\ProxyTrunks
 *
 * @package Mapper
 * @subpackage Sql
 * @author Luis Felipe Garcia
 */
namespace IvozProvider\Mapper\Sql;
class ProxyTrunks extends Raw\ProxyTrunks
{
    protected function _save(\IvozProvider\Model\Raw\ProxyTrunks $model,
            $recursive = false, $useTransaction = true, $transactionTag = null, $forceInsert = false
    )
    {
        $response = parent::_save($model, $recursive, $useTransaction, $transactionTag, $forceInsert);
        
        if ($response) {
            // Replicate Terminal into ast_ps_endpoint
            $endpointMapper = new \IvozProvider\Mapper\Sql\AstPsEndpoints();
            $endpoint = $endpointMapper->findOneByField("proxyTrunkId", $response);

            // If not found create a new one
            if (is_null($endpoint)) {
                $endpoint = new \IvozProvider\Model\AstPsEndpoints();
            }
            
            // Update/Insert endpoint data
            $endpoint->setProxyTrunkId($response)
                ->setSorceryId($model->getName())
                ->setAors($model->getName())
                ->setContext("incoming")
                ->setDisallow($model->getDisallow())
                ->setAllow($model->getAllow())
                ->setDirectMedia($model->getDirectMedia())
                ->setDirectMediaMethod($model->getDirectMediaMethod())
                ->save();
        }
        return $response;
    }
}
