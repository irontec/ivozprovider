<?php

/**
 * Application Model
 *
 * @package IvozProvider\Model
 * @subpackage Model
 * @author Luis Felipe Garcia
 * @copyright ZF model generator
 * @license http://framework.zend.com/license/new-bsd     New BSD License
 */

/**
 * [entity]
 *
 * @package IvozProvider\Model
 * @subpackage Model
 * @author Luis Felipe Garcia
 */

namespace IvozProvider\Model;
class Terminals extends Raw\Terminals
{
    /**
     * This method is called just after parent's constructor
     */
    public function init()
    {
    }

    /**
     * Gets dependent Users_ibfk_3
     *
     * @param string or array $where
     * @return object of \IvozProvider\Model\Raw\Users
     */
    public function getUser($where = null)
    {
        $users = $this->getUsers($where);
        return array_shift($users);
    }

    public function getContact()
    {
        return sprintf("sip:%s@%s",
            $this->getName(),
            $this->getDomain());
    }

    public function getSorcery()
    {
        return sprintf("b%dc%dt%d_%s",
            $this->getCompany()->getBrandId(),
            $this->getCompanyId(),
            $this->getId(),
            $this->getName());
    }
}
