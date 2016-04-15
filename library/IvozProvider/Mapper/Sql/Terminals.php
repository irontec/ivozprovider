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
 * Data Mapper implementation for IvozProvider\Model\Terminals
 *
 * @package Mapper
 * @subpackage Sql
 * @author Luis Felipe Garcia
 */
namespace IvozProvider\Mapper\Sql;
class Terminals extends Raw\Terminals
{
    protected function _save(\IvozProvider\Model\Raw\Terminals $model,
            $recursive = false, $useTransaction = true, $transactionTag = null, $forceInsert = false
    )
    {
        $mac = $model->getMac();
        $mac = strtolower($mac);
        $mac = preg_replace("/[^A-Za-z0-9]/", '', $mac);
        if( preg_match('/^[a-f0-9]*$/', $mac) ){
            $model->setMac($mac);
        } else {
            throw new \Exception('Invalid mac', 417);
        }
        
        $response = parent::_save($model, $recursive, $useTransaction, $transactionTag, $forceInsert);
        if ($response) {
            // Replicate Terminal into ast_ps_endpoint
            $endpointMapper = new \IvozProvider\Mapper\Sql\AstPsEndpoints();
            $endpoint = $endpointMapper->findOneByField("id", $response);

            // If not found create a new one
            $forceInsert = false;
            if (is_null($endpoint)) {
                $forceInsert = true;
                $endpoint = new \IvozProvider\Model\AstPsEndpoints();
            }
            // Update/Insert endpoint data
            $endpoint->setId($response)
                ->setSorceryId($model->getName())
                ->setAors($model->getName())
                ->setDirectmedia($model->getDirectmedia())
                ->setAllow($model->getAllow())
                ->setSubscribecontext($model->getCompanyId())
                ->save($forceInsert);

            // Replicate Terminal into ast_ps_aors
            $aorMapper = new \IvozProvider\Mapper\Sql\AstPsAors();
            $aor = $aorMapper->findOneByField("id", $response);

            // If not found create a new one
            $forceInsert = false;
            if (is_null($aor)) {
                $forceInsert = true;
                $aor = new \IvozProvider\Model\AstPsAors();
            }
            $aor->setId($response)
                ->setSorceryId($model->getName())
                ->setMaxContacts(1)
                ->setRemoveExisting('yes')
                ->save($forceInsert);
        }
    }

    public function delete(\IvozProvider\Model\Raw\ModelAbstract $model)
    {
        $response = parent::delete($model);

        // Delete its endpoint
        $endpointMapper = new \IvozProvider\Mapper\Sql\AstPsEndpoints();
        $endpoint = $endpointMapper->findOneByField("id", $model->getId());
        if ($endpoint) {
            $endpointMapper->delete($endpoint);
        }

        // Delete its aor
        $aorMapper = new \IvozProvider\Mapper\Sql\AstPsAors();
        $aor = $aorMapper->findOneByField("id", $model->getId());
        if ($aor) {
            $aorMapper->delete($aor);
        }
        
        // Delete its contacts
        $contactMapper = new \IvozProvider\Mapper\Sql\AstPsContacts();
        $contacts = $contactMapper->fetchList("sorcery_id LIKE '" . $model->getName() . "^3B%'");
        
        foreach ($contacts as $contact) {
            $contactMapper->delete($contact);
        }
        
        return $response;
    }
}
