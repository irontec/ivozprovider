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

        $pk = parent::_save($model, $recursive, $useTransaction, $transactionTag, $forceInsert);

        $this->_updateDomains($model);

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

        $name = $model->getDomainTrunks();
        $name = trim($name);

        $domainMapper = new \IvozProvider\Mapper\Sql\Domains();
        $domains = $domainMapper->fetchList("brandId=$pk AND PointsTo='proxytrunks'");

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
               ->setPointsTo('proxytrunks')
               ->setBrandId($pk)
               ->setDescription($model->getName() . " proxytrunks domain")
               ->save();
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
                'proxytrunks' => array("lcr.reload", "domain.reload"),
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
