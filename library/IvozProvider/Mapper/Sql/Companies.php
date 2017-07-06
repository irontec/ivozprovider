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
 * Data Mapper implementation for IvozProvider\Model\Companies
 *
 * @package Mapper
 * @subpackage Sql
 * @author Luis Felipe Garcia
 */
namespace IvozProvider\Mapper\Sql;
use IvozProvider\Gearmand\Jobs\Xmlrpc;

class Companies extends Raw\Companies
{
    protected $_model;
    protected $_recursive;
    protected function _save(\IvozProvider\Model\Raw\Companies $model,
            $recursive = false, $useTransaction = true, $transactionTag = null, $forceInsert = false
    )
    {
        $isNew = !$model->getPrimaryKey();

        $this->_model = $model;
        $this->_recursive = $recursive;
        if (is_null($model->getPrimaryKey())) {
            $this->_propagateCallACLPatterns();
        }

        if ($isNew) {
            // Create sane defaults for hidden fields
            if (!$model->hasChange('nif')) $model->setNif('12345678-Z');
            if (!$model->hasChange('postalAddress')) $model->setPostalAddress('Postal address');
            if (!$model->hasChange('postalCode')) $model->setPostalCode('PC');
            if (!$model->hasChange('town')) $model->setTown('Town');
            if (!$model->hasChange('country')) $model->setCountry('Country');
            if (!$model->hasChange('province')) $model->setProvince('Province');
            if (!$model->hasChange('defaultTimezoneId')) $model->setDefaultTimezoneId($model->getBrand()->getDefaultTimezoneId());
            if (!$model->hasChange('countryId')) $model->setCountryId(70);
            if (!$model->hasChange('languageId')) $model->setLanguageId($model->getBrand()->getLanguageId());
            if (!$model->hasChange('outbound_prefix')) $model->setOutboundPrefix('');
            if (!$model->hasChange('mediaRelaySetsId')) $model->setMediaRelaySetsId(0);
            if (!$model->hasChange('onDemandRecord')) $model->setOnDemandRecord(0);
            if (!$model->hasChange('onDemandRecordCode')) $model->setOnDemandRecordCode('');
            if (!$model->hasChange('areaCode')) $model->setAreaCode('');
        }

        // Remove code if on-demand recording is disabled
        if ($model->getOnDemandRecord() == 0) {
            $model->setOnDemandRecordCode('');
        }

        $pk = parent::_save($this->_model, $this->_recursive, $useTransaction, $transactionTag, $forceInsert);

        if ($model->hasChange('domainUsers')) {
            $this->_updateDomains($model);
        }

        if ($isNew) {
            $this->_createDomainAttrs($model);
            $this->_propagateServices($model);
        }

        try {
            $this->_sendXmlRcp();
        } catch (\Exception $e) {
            $message = $e->getMessage()."<p>Company may have been saved.</p>";
            throw new \Exception($message);
        }

        return $pk;
    }

    protected function _createDomainAttrs($model)
    {
        // Only Create Domain Attributes if company has domain
        if ($model->getType() !== $model::VPBX) {
            return;
        }

        $domainAttr = new \IvozProvider\Model\KamUsersDomainAttrs();

        $domainAttr->setDid($model->getDomainUsers())
                   ->setName('brandId')
                   ->setType('0')
                   ->setValue($model->getBrand()->getPrimaryKey())
                   ->save();
    }

    protected function _updateDomains($model)
    {
        $pk = $model->getPrimaryKey();
        $domainMapper = new \IvozProvider\Mapper\Sql\Domains();
        $domains = $domainMapper->fetchList("companyId=$pk AND PointsTo='proxyusers'");

        // If domain field is filled, look for brand domains or create a new one
        if (empty($domains)) {
            $domain = new \IvozProvider\Model\Domains();
        } else {
            $domain = $domains[0];
            $this->_updateTerminalsDomain($model, $domain);
            $this->_updateFriendsDomain($model, $domain);
        }

        $name = $model->getDomainUsers();
        $domain->setDomain($name)
               ->setScope('company')
               ->setPointsTo('proxyusers')
               ->setCompanyId($pk)
               ->setDescription($model->getName() . " proxyusers domain")
               ->save();
    }

    protected function _updateTerminalsDomain($model, $domain)
    {
        $terminals = $model->getTerminals();

        foreach ($terminals as $terminal) {
            $terminal->setDomain($domain->getDomain())->save();
            $endpoint = $terminal->getAstPsEndpoint();
            $aor = $endpoint->getAstPsAor();

            $aor->setContact($terminal->getContact())
                ->save();
        }
    }

    protected function _updateFriendsDomain($model, $domain)
    {
        $friends = $model->getFriends();

        foreach ($friends as $friend) {
            $friend->setDomain($domain->getDomain())->save();

            $endpoint = $friend->getAstPsEndpoint();
            $aor = $endpoint->getAstPsAor();

            $aor->setContact($friend->getContact())
                ->save();
        }
    }

    protected function _propagateCallACLPatterns()
    {
        $brand = $this->_model->getBrand();
        if (is_null($brand)) {
            throw new \Exception(_("Brand is not set"), 60000);
        }
        $genericCallACLPatterns = $brand->getGenericCallACLPatterns();
        $callACLPatterns = array();
        foreach ($genericCallACLPatterns as $genericCallACLPattern) {
            $callACLPattern = new \IvozProvider\Model\CallACLPatterns();
            $callACLPattern
            ->setCompany($this->_model)
            ->setName($genericCallACLPattern->getName())
            ->setRegExp($genericCallACLPattern->getRegExp());
            $callACLPatterns[] = $callACLPattern;
        }
        if (!empty($callACLPatterns)) {
            $this->_model->setCallACLPatterns($callACLPatterns);
            $this->_recursive = true;
        }
    }

    protected function _propagateServices($model)
    {
        $servicesMapper = new \IvozProvider\Mapper\Sql\BrandServices();
        $services = $servicesMapper->fetchList("brandId=" . $model->getBrandId());
        foreach ($services as $service) {
            $newService = new \IvozProvider\Model\CompanyServices();
            $newService->setServiceId($service->getServiceId())
                       ->setCode($service->getCode())
                       ->setCompanyId($model->getPrimaryKey())
                       ->save();
        }
    }

    public function delete(\IvozProvider\Model\Raw\ModelAbstract $model)
    {
        $response = parent::delete($model);
        try {
            $this->_sendXmlRcp();
        } catch (\Exception $e) {
            $message = $e->getMessage()."<p>Company may have been deleted.</p>";
            throw new \Exception($message);
        }
        return $response;
    }

    protected function _sendXmlRcp()
    {
        $proxyServers = array(
                'proxytrunks' => "lcr.reload",
                'proxyusers'  => array("domain.reload", "permissions.addressReload"),
        );
        $xmlrpcJob = new Xmlrpc();
        $xmlrpcJob->setProxyServers($proxyServers);
        $xmlrpcJob->send();
    }
}
