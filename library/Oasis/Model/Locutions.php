<?php

/**
 * Application Model
 *
 * @package Oasis\Model
 * @subpackage Model
 * @author Luis Felipe Garcia
 * @copyright ZF model generator
 * @license http://framework.zend.com/license/new-bsd New BSD License
 */

/**
 * [entity]
 *
 * @package Oasis\Model
 * @subpackage Model
 * @author Luis Felipe Garcia
 */
namespace Oasis\Model;

class Locutions extends Raw\Locutions
{

    /**
     * This method is called just after parent's constructor
     */
    public function init ()
    {}

    public function getLocutionPath ()
    {
        return substr($this->fetchFile()->getFilePath(), 0, - 4);
    }
}
