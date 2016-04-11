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
class ProxyTrunks extends Raw\ProxyTrunks
{
    /**
     * This method is called just after parent's constructor
     */
    public function init()
    {
    }


    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\Terminals
     */
    public function setName($data)
    {
        $this->setSorceryId($data);
        $this->setAors($data);

        return parent::setName($data);
    }
}
