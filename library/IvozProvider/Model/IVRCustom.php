<?php

/**
 * Application Model
 *
 * @package IvozProvider\Model
 * @subpackage Model
 * @author Luis Felipe Garcia
 * @copyright ZF model generator
 * @license http://framework.zend.com/license/new-bsd New BSD License
 */

/**
 * [entity]
 *
 * @package IvozProvider\Model
 * @subpackage Model
 * @author Luis Felipe Garcia
 */
namespace IvozProvider\Model;

class IVRCustom extends Raw\IVRCustom
{

    /**
     * This method is called just after parent's constructor
     */
    public function init ()
    {}

    /*
     * @return array The array of \IvozProvider\Model\Raw\Locutions with key=>value
     */
    public function getAllLocutions ()
    {
        $locutions = array();
        $locutions['welcome'] = $this->getWelcomeLocution();
        $locutions['noanswer'] = $this->getNoAnswerLocution();
        $locutions['error'] = $this->getErrorLocution();
        $locutions['success'] = $this->getSuccessLocution();
        return $locutions;
    }
}
