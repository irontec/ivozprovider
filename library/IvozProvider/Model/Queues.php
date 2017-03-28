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
class Queues extends Raw\Queues
{
    /**
     * This method is called just after parent's constructor
     */
    public function init()
    {
    }

    public function getAstQueueName()
    {
        return sprintf("b%dc%dq%d_%s",
            $this->getCompany()->getBrandId(),
            $this->getCompanyId(),
            $this->getId(),
            $this->getName());

    }
}
