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
class Extensions extends Raw\Extensions
{
    /**
     * This method is called just after parent's constructor
     */
    public function init()
    {
    }
    public function getUser($where = null)
    {
        $users = $this->getUsers($where);
        return array_shift($users);
    }

    public function toArrayPortal()
    {

        $model = array();

        $model['id'] = $this->getId();
        $model['number'] = $this->getNumber();

        return $model;

    }

}