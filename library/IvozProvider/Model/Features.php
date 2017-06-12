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
 * [entity][rest]
 *
 * @package IvozProvider\Model
 * @subpackage Model
 * @author Luis Felipe Garcia
 */

namespace IvozProvider\Model;
class Features extends Raw\Features
{
    /**
     * Available features Ids
     */
    const QUEUES            = 1;
    const RECORDINGS        = 2;
    const FAXES             = 3;
    const FRIENDS           = 4;
    const CONFERENCES       = 5;
    const BILLING           = 6;
    const INVOICES          = 7;
    const PROGRESS          = 8;
    const RETAIL            = 9;

    /**

     * This method is called just after parent's constructor
     */
    public function init()
    {
    }
}
