<?php

/**
 * Application Model
 *
 * @package Oasis\Model
 * @subpackage Model
 * @author Luis Felipe Garcia
 * @copyright ZF model generator
 * @license http://framework.zend.com/license/new-bsd     New BSD License
 */

/**
 * [entity]
 *
 * @package Oasis\Model
 * @subpackage Model
 * @author Luis Felipe Garcia
 */

namespace Oasis\Model;
class Users extends Raw\Users
{
    /**
     * This method is called just after parent's constructor
     */
    public function init()
    {
    }

    /**
     * Gets dependent Extensions_ibfk_2
     *
     * @param string or array $where
     * @return array The array of \Oasis\Model\Raw\Extensions
     *
     public function getExtension($where = null)
     {
     $extensions = $this->getExtensions($where, null, null);
     return array_shift($extensions);
     }

     /**
     * @return string or null
     */
    public function getUserTerminalInterface()
    {
        $terminal = $this->getTerminal();
        if (empty($terminal)) {
            return null;
        }
        return $terminal->getName();

    }

    /**
     * @return string
     */
    public function getOutgoingDDINumber($valueIfEmpty = "anonimo")
    {
        $DDI = $this->getOutgoingDDI();
        if ($DDI) {
            return $DDI->getDDI();
        }
        return $valueIfEmpty;
    }

    /**
     * @return string
     */
    public function getExtensionNumber()
    {
        $extension = $this->getExtension();
        if ($extension) {
            return $extension->getNumber();
        }
        return "";
    }

    /**
     * @return string or null
     */
    public function getDomain()
    {
        $compnies = $this->getCompany();
        if (!$compnies) {
            return null;
        }
        $brand = $compnies->getBrand();
        if (!$brand) {
            return null;
        }
        return $brand->getDomain();
    }

    /**
     * @param string $exten
     * @return bool canCall
     */
    public function hasSrcUserPerm($exten)
    {
        $callAcl = $this->getCallACL();
        if (empty($callAcl)) {
            return true;
        }
        return $callAcl->dstIsCallable($exten);
    }

    /**
    *
    * @param string $exten
    * @return bool tarificable
    */
    public function isDstTarificable ($exten)
    {
        $call = new \Oasis\Model\ParsedCDRs();
        $call->setDst($exten)
            ->setCompanyId($this->getCompanyId())
            ->setCalldate(new \Zend_Date());
        $result = $call->tarificate();
        if (is_null($result)) {
            return false;
        }
        return true;
    }
    
    public function getPickUpGroups()
    {
        $pickUpGroups = array();
        $pickUpRelUsers = $this->getPickUpRelUsers();
        if (!empty($pickUpRelUsers)) {
            foreach ($pickUpRelUsers as $key => $pickUpRelUser) {
                $pickUpGroups[$key] = $pickUpRelUser->getPickUpGroup();
            }
        }
        return $pickUpGroups;
    }

    /**
     * @return string
     */
    public function getFullName()
    {
        $fullName = $this->getName() . ' ' . $this->getLastname();
        return $fullName;
    }

    public function toArrayPortalForm()
    {

        $model = array();

        $model['id'] = $this->getId();
        $model['name'] = $this->getFullName();

        return $model;

    }

    public function canBeCalled()
    {
        // Check if user is valid to be called
        if (! $this->getActive()) {
            return false;
        }

        // Check if user has terminal configured
        if (empty($this->getTerminal())) {
            return false;
        }

        // Check if user has extension configured
        if (empty($this->getExtension())) {
            return false;
        }

        // Looks like a complete user
        return true;
    }
}
