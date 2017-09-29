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
 * Data Mapper implementation for IvozProvider\Model\RetailAccounts
 *
 * @package Mapper
 * @subpackage Sql
 * @author Luis Felipe Garcia
 */
namespace IvozProvider\Mapper\Sql;
class RetailAccounts extends Raw\RetailAccounts
{

    /*
     * Mysql error code list:
     * https://dev.mysql.com/doc/refman/5.5/en/error-messages-server.html
     */
    const MYSQL_ERROR_DUPLICATE_ENTRY = 1062;
    const UNIQUE_NAME_CONSTRAINT = 'nameBrand';

    /**
     * Saves current row
     * @return integer primary key for autoincrement fields if the save action was successful
     */
    protected function _save(\IvozProvider\Model\Raw\RetailAccounts $model,
        $recursive = false, $useTransaction = true, $transactionTag = null, $forceInsert = false
    ) {
        // Set account domain to its brand domain
        $model->setDomain($model->getCompany()->getBrand()->getDomainUsers());

        try {
            $response = parent::_save($model, $recursive, $useTransaction, $transactionTag, $forceInsert);
        } catch (\Exception $e) {
            $isDuplicatedNameError =
                $e->getCode() === self::MYSQL_ERROR_DUPLICATE_ENTRY
                && strpos($e->getMessage(), self::UNIQUE_NAME_CONSTRAINT);
            if ($isDuplicatedNameError) {
                throw new \Exception('Name already in use', 2203, $e);
            }
            throw $e;
        }

        if ($response) {
            // Replicate Account into ast_ps_endpoint
            $endpointMapper = new \IvozProvider\Mapper\Sql\AstPsEndpoints();
            $endpoint = $endpointMapper->findOneByField("retailAccountId", $response);

            // If not found create a new one
            $forceInsert = false;
            if (is_null($endpoint)) {
                $forceInsert = true;
                $endpoint = new \IvozProvider\Model\AstPsEndpoints();
                $endpoint->setContext("retail")
                    ->setSendDiversion("yes")
                    ->setSendPai("yes");
            }

            // Update/Insert endpoint data
            $endpoint->setRetailAccountId($response)
                ->setSorceryId($model->getSorcery())
                ->setFromDomain($model->getDomain())
                ->setAors($model->getSorcery())
                ->setDisallow($model->getDisallow())
                ->setAllow($model->getAllow())
                ->setDirectmediaMethod($model->getDirectmediaMethod())
                ->setTrustIdInbound('yes')
                ->setOutboundProxy('sip:users.ivozprovider.local^3Blr')
                ->setDirectMediaMethod('invite')
                ->save($forceInsert);

            // Replicate Account into ast_ps_aors
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
