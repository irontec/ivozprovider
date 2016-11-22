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
class LcrRules extends Raw\LcrRules
{
    /**
     * This method is called just after parent's constructor
     */
    public function init()
    {
    }

    public function setOutgoingRouting(\IvozProvider\Model\Raw\OutgoingRouting $outgoingRouting)
    {
        $this->setOutgoingRoutingId($outgoingRouting->getPrimaryKey());

        if (!is_null($outgoingRouting->getCompany())) {
            $this->setFromUri(sprintf("^b%dc%d$", $outgoingRouting->getBrandId(), $outgoingRouting->getCompanyId()));
        } else {
            $this->setFromUri(sprintf("^b%dc[0-9]+$", $outgoingRouting->getBrandId()));
        }

        return $this;
    }

    public function setCondition($regexp)
    {
        if (is_numeric($regexp) || $regexp == 'fax') {
            $this->setPrefix($regexp);
            $this->setRequestUri(null);
        } else {
            $ruri_regexp = $regexp;

            if(substr($ruri_regexp, 0, 1) == '^') {
                $ruri_regexp = ':' . substr($ruri_regexp,1);
            }

            if(substr($ruri_regexp, -1) == '$') {
                $ruri_regexp = substr($ruri_regexp, 0, -1) . '@';
            }

            $this->setRequestUri($ruri_regexp);
            $this->setPrefix(null);
        }
        return $this;
    }
}
