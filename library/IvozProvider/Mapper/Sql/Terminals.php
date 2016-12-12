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

        // Set terminal domain to its company user domain
        $model->setDomain($model->getCompany()->getDomainUsers());

        $response = parent::_save($model, $recursive, $useTransaction, $transactionTag, $forceInsert);
        if ($response) {
            // Replicate Terminal into ast_ps_endpoint
            $endpointMapper = new \IvozProvider\Mapper\Sql\AstPsEndpoints();
            $endpoint = $endpointMapper->findOneByField("terminalId", $response);

            // If not found create a new one
            $forceInsert = false;
            if (is_null($endpoint)) {
                $forceInsert = true;
                $endpoint = new \IvozProvider\Model\AstPsEndpoints();
                $endpoint->setContext("users")
                    ->setSendDiversion("yes")
                    ->setSendPai("yes");
            }
            // Update/Insert endpoint data
            $endpoint->setTerminalId($response)
                ->setSorceryId($model->getSorcery())
                ->setAors($model->getSorcery())
                ->setDisallow($model->getDisallow())
                ->setAllow($model->getAllow())
                ->setDirectmediaMethod($model->getDirectmediaMethod())
                ->setSubscribecontext('company' . $model->getCompanyId())
                ->setOutboundProxy('sip:users.ivozprovider.local^3Blr')
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
                ->setSorceryId($model->getSorcery())
                ->setContact($model->getContact())
                ->setMaxContacts(1)
                ->setQualifyFrequency(0)
                ->setRemoveExisting('yes')
                ->save($forceInsert);
        }
    }
}
