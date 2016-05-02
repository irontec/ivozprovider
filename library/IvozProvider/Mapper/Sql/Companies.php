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
        $this->_model = $model;
        $this->_recursive = $recursive;
        if (is_null($model->getPrimaryKey())) {
            $this->_propagateCallACLPatterns();
        }

        $pk = parent::_save($this->_model, $this->_recursive, $useTransaction, $transactionTag, $forceInsert);

        $this->_updateDomains($model);

        try {
            $this->_sendXmlRcp();
        } catch (\Exception $e) {
            $message = $e->getMessage()."<p>Company may have been saved.</p>";
            throw new \Exception($message);
        }

        return $pk;
    }

    protected function _updateDomains($model)
    {
        $pk = $model->getPrimaryKey();
        $domainMapper = new \IvozProvider\Mapper\Sql\Domains();

        $domains = $domainMapper->fetchList("companyId=$pk AND PointsTo='proxyusers'");
        if (empty($domains)) {
            $domain = new \IvozProvider\Model\Domains();
        } else {
            $domain = $domains[0];
        }

        $name = trim($model->getDomainUsers());
        if (!$name) {
            $domain->delete();
            return;
        }

        $domain->setDomain($name)
               ->setScope('company')
               ->setPointsTo('proxyusers')
               ->setCompanyId($pk)
               ->setDescription($model->getName() . " proxyusers domain")
               ->save();
    }

    protected function _propagateCallACLPatterns()
    {
        $brand = $this->_model->getBrand();
        if (is_null($brand)) {
            throw new \Exception(_("Brand is not setted"), 60000);
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
                'proxytrunks' => array("lcr.reload", "domain.reload"),
                'proxyusers'  => array("domain.reload", "permissions.addressReload"),
        );
        $xmlrpcJob = new Xmlrpc();
        $xmlrpcJob->setProxyServers($proxyServers);
        $xmlrpcJob->send();
    }
}
