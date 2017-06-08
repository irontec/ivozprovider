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
 * Data Mapper implementation for IvozProvider\Model\Brands
 *
 * @package Mapper
 * @subpackage Sql
 * @author Luis Felipe Garcia
 */
namespace IvozProvider\Mapper\Sql;

use IvozProvider\Gearmand\Jobs\Xmlrpc;
class Brands extends Raw\Brands
{

    protected function _save(\IvozProvider\Model\Raw\Brands $model,
            $recursive = false, $useTransaction = true, $transactionTag = null, $forceInsert = false
    )
    {
        $isNew = !$model->getPrimaryKey();

        if ($isNew) {
            // Create sane defaults for hidden fields
            if (!$model->hasChange('nif')) $model->setNif('12345678-Z');
            if (!$model->hasChange('postalAddress')) $model->setPostalAddress('Postal address');
            if (!$model->hasChange('postalCode')) $model->setPostalCode('ZIP');
            if (!$model->hasChange('town')) $model->setTown('Town');
            if (!$model->hasChange('country')) $model->setCountry('Country');
            if (!$model->hasChange('province')) $model->setProvince('Province');
            if (!$model->hasChange('defaultTimezoneId')) $model->setDefaultTimezoneId(145);
            if (!$model->hasChange('languageId')) $model->setLanguageId(1);
            if (!$model->hasChange('registryData')) $model->setRegistryData('');
        }

        $pk = parent::_save($model, $recursive, $useTransaction, $transactionTag, $forceInsert);

        if ($model->hasChange('domainUsers')) {
            $this->_updateDomains($model);
            $this->_updateRetailDomain($model);
            $this->_createDomainAttrs($model);
        }

        if ($isNew) {
            $this->_createDefaultRoutes($model);
            $this->_createDefaultServices($model);
        }

        try {
            $this->_sendXmlRcp();
        } catch (\Exception $e) {
            $message = $e->getMessage()."<p>Brand may have been saved.</p>";
            throw new \Exception($message);
        }

        return $pk;
    }

    protected function _createDomainAttrs($model)
    {
        $domainName = $model->getDomainUsers();

        if (!empty($domainName)) {
            $domainAttrsMapper = new \IvozProvider\Mapper\Sql\KamUsersDomainAttrs();

            $domainsAttr = $domainAttrsMapper->fetchList("did='$domainName' AND name='brandId'");
            if (empty($domainsAttr)) {
                $domainAttr = new \IvozProvider\Model\KamUsersDomainAttrs();

                $domainAttr->setDid($domainName)
                           ->setName('brandId')
                           ->setType('0')
                           ->setValue($model->getPrimaryKey())
                           ->save();
            }
        }
    }

    protected function _createDefaultRoutes($model)
    {
        $routingPatternGroupsMapper = new \IvozProvider\Mapper\Sql\RoutingPatternGroups();

        $countriesMapper = new \IvozProvider\Mapper\Sql\Countries();
        $countries = $countriesMapper->fetchAll();

        foreach ($countries as $country) {
            $routingPattern = new \IvozProvider\Model\RoutingPatterns();
            $routingPattern->setNameEs($country->getNameEs())
                           ->setNameEn($country->getNameEn())
                           ->setDescriptionEs('')
                           ->setDescriptionEn('')
                           ->setRegExp($country->getCallingCode())
                           ->setBrandId($model->getPrimaryKey())
                           ->save();
            if ($country->getZone()) {
                $routingPatternGroups = $routingPatternGroupsMapper->fetchList("brandId=" . $model->getPrimaryKey() . " AND name='" . $country->getZone() . "'");
                if (empty($routingPatternGroups)) {
                    $routingPatternGroup = new \IvozProvider\Model\RoutingPatternGroups();
                    $routingPatternGroup->setName($country->getZone())
                                        ->setBrandId($model->getPrimaryKey())
                                        ->save();
                } else {
                    $routingPatternGroup = $routingPatternGroups[0];
                }

                $routingPatternGroupsRelPatterns = new \IvozProvider\Model\RoutingPatternGroupsRelPatterns();
                $routingPatternGroupsRelPatterns->setRoutingPatternId($routingPattern->getPrimaryKey())
                                                ->setRoutingPatternGroupid($routingPatternGroup->getPrimaryKey())
                                                ->save();
            }
        }
    }

    protected function _createDefaultServices($model)
    {
        $servicesMapper = new \IvozProvider\Mapper\Sql\Services();
        $services = $servicesMapper->fetchAll();
        foreach ($services as $service) {
            $newService = new \IvozProvider\Model\BrandServices();
            $newService->setServiceId($service->getId())
                       ->setCode($service->getDefaultCode())
                       ->setBrandId($model->getPrimaryKey())
                       ->save();
        }
    }

    protected function _updateDomains($model)
    {
        $pk = $model->getPrimaryKey();

        $name = $model->getDomainUsers();
        $name = trim($name);

        $domainMapper = new \IvozProvider\Mapper\Sql\Domains();
        $domains = $domainMapper->fetchList("brandId=$pk AND PointsTo='proxyusers'");

        // Empty domain field, delete any related domain
        if (!$name) {
            foreach ($domains as $domain) {
                $domain->delete();
            }
            return;
        } else {
            // If domain field is filled, look for brand domains or create a new one
            if (empty($domains)) {
                $domain = new \IvozProvider\Model\Domains();
            } else {
                $domain = $domains[0];
            }
        }

        $domain->setDomain($name)
               ->setScope('brand')
               ->setPointsTo('proxyusers')
               ->setBrandId($pk)
               ->setDescription($model->getName() . " proxyusers domain")
               ->save();
    }

    protected function _updateRetailDomain($model)
    {
        $retails = $model->getRetailAccounts();
        foreach ($retails as $retail) {
            $retail->setDomain($model->getDomainUsers())->save();
        }
    }

    public function delete(\IvozProvider\Model\Raw\ModelAbstract $model)
    {
        $response = parent::delete($model);
        try {
            $this->_sendXmlRcp();
        } catch (\Exception $e) {
            $message = $e->getMessage()."<p>Brand may have been deleted.</p>";
            throw new \Exception($message);
        }
        return $response;
    }

    protected function _sendXmlRcp()
    {
        $proxyServers = array(
                'proxytrunks' => "lcr.reload",
                'proxyusers' => "domain.reload",
        );
        $xmlrpcJob = new Xmlrpc();
        $xmlrpcJob->setProxyServers($proxyServers);
        $xmlrpcJob->send();
    }

    protected function _testLogs()
    {
        $bootstrap = \Zend_Controller_Front::getInstance()->getParam('bootstrap');
        $logger = $bootstrap->getResource('log');

        $logger->log("EMERG", \Zend_Log::EMERG);
        $logger->log("ALERT", \Zend_Log::ALERT);
        $logger->log("CRIT", \Zend_Log::CRIT);
        $logger->log("ERR", \Zend_Log::ERR);
        $logger->log("WARN", \Zend_Log::WARN);
        $logger->log("NOTICE", \Zend_Log::NOTICE);
        $logger->log("INFO", \Zend_Log::INFO);
        $logger->log("DEBUG", \Zend_Log::DEBUG);
        $logger->log("[MAIL] Mensaje por e-mail", \Zend_Log::INFO);
        $logger->log("[Brands] Mensaje por e-mail", \Zend_Log::NOTICE);
    }

}
