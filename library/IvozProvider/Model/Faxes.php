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
class Faxes extends Raw\Faxes
{
    /**
     * This method is called just after parent's constructor
     */
    public function init()
    {
    }

    /**
     * Get Fax outgoingDDI
     * If no DDI is assigned, retrieve company's default DDI
     * @return \IvozProvider\Model\Raw\DDIs or NULL
     */
    public function getOutgoingDDI($where = null, $orderBy = null, $avoidLoading = false)
    {
        $ddi = parent::getOutgoingDDI($where, $orderBy, $avoidLoading);
        if (empty($ddi)) {
            $ddi = $this->getCompany()->getOutgoingDDI($where, $orderBy, $avoidLoading);
        }
        return $ddi;
    }

}
