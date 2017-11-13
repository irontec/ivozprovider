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
 * Data Mapper implementation for IvozProvider\Model\Friends
 *
 * @package Mapper
 * @subpackage Sql
 * @author Luis Felipe Garcia
 */
namespace IvozProvider\Mapper\Sql;
class Friends extends Raw\Friends
{
    /**
     * Saves current row
     * @return integer primary key for autoincrement fields if the save action was successful
     */
    protected function _save(\IvozProvider\Model\Raw\Friends $model,
        $recursive = false, $useTransaction = true, $transactionTag = null, $forceInsert = false
    ) {
        // Set friend domain to its company user domain
        $model->setDomain($model->getCompany()->getDomainUsers());

        $response = parent::_save($model, $recursive, $useTransaction, $transactionTag, $forceInsert);
        if ($response) {
            // Replicate Terminal into ast_ps_endpoint
            $endpointMapper = new \IvozProvider\Mapper\Sql\AstPsEndpoints();
            $endpoint = $endpointMapper->findOneByField("friendId", $response);

            // If not found create a new one
            $forceInsert = false;
            if (is_null($endpoint)) {
                $forceInsert = true;
                $endpoint = new \IvozProvider\Model\AstPsEndpoints();
                $endpoint->setContext("friends")
                    ->setSendDiversion("yes")
                    ->setSendPai("yes");
            }

            $fromDomain = $model->getFromDomain()
                ? $model->getFromDomain()
                : $model->getCompany()->getDomainUsers();

            // Update/Insert endpoint data
            $endpoint->setFriendId($response)
                ->setSorceryId($model->getSorcery())
                ->setFromDomain($fromDomain)
                ->setAors($model->getSorcery())
                ->setDisallow($model->getDisallow())
                ->setAllow($model->getAllow())
                ->setDirectmediaMethod($model->getDirectmediaMethod())
                ->setTrustIdInbound('yes')
                ->setOutboundProxy('sip:users.ivozprovider.local^3Blr')
                ->setDirectMediaMethod('invite')
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
