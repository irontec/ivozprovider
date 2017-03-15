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
class DDIs extends Raw\DDIs
{
    /**
     * This method is called just after parent's constructor
     */
    public function init()
    {
    }

    /**
     * @return string Domain
     */
    public function getDomain()
    {
        $compnies = $this->getCompany();
        if(!$compnies) {
            return null;
        }
        $brand = $compnies->getBrand();
        if(!$brand) {
            return null;
        }
        return $brand->getDomain();
    }

    public function getLanguageCode()
    {
        $language = $this->getLanguage();
        if (!$language) {
            return $this->getCompany()->getLanguageCode();
        }
        return $language->getIden();
    }

}
