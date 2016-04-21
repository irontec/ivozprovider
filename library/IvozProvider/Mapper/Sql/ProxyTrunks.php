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
            $forceInsert = false;
            if (is_null($endpoint)) {
                $forceInsert = true;
                $endpoint = new \IvozProvider\Model\AstPsEndpoints();
            }
            
            // Update/Insert endpoint data
            $endpoint->setProxyTrunkId($response)
                ->setSorceryId($model->getName())
                ->setAors($model->getName())
                ->setContext("incoming")
                ->setDirectMedia("yes")
                //->setDirectMediaMethod("invite")
                ->save($forceInsert);
            
            // Replicate Terminal into ast_ps_aors
            $aorMapper = new \IvozProvider\Mapper\Sql\AstPsAors();
            $aor = $aorMapper->findOneByField("id", $endpoint->getId());
            
            // If not found create a new one
            $forceInsert = false;
            if (is_null($aor)) {
                $forceInsert = true;
                $aor = new \IvozProvider\Model\AstPsAors();
            }
            $aor->setId($endpoint->getId())
                ->setSorceryId($model->getName())
                ->setMaxContacts(1)
                ->setContact("sip:" . $model->getIp())
                ->setQualifyFrequency(30)
                ->setRemoveExisting('yes')
                ->save($forceInsert);
                
            // Replicate Terminal into ast_ps_endpoint
            $identifyMapper = new \IvozProvider\Mapper\Sql\AstPsIdentify();
            $identify = $identifyMapper->findOneByField("id", $endpoint->getId());
            
            // If not found create a new one
            $forceInsert = false;
            if (is_null($identify)) {
                $forceInsert = true;
                $identify = new \IvozProvider\Model\AstPsIdentify();
            }
            
            // Update/Insert endpoint data
            $identify->setId($endpoint->getId())
                ->setSorceryId($model->getName())
                ->setEndpoint($model->getName())
                ->setMatch($model->getIp())
                ->save($forceInsert);
        }
        return $response;
    }
}
