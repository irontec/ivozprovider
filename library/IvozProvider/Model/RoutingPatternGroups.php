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
class RoutingPatternGroups extends Raw\RoutingPatternGroups
{
    /**
     * This method is called just after parent's constructor
     */
    public function init()
    {
    }

    public function getRoutingPatterns()
    {
        $patterns = array();
        $rels = $this->getRoutingPatternGroupsRelPatterns();

        foreach ($rels as $rel) {
            array_push($patterns, $rel->getRoutingPattern());
        }

        return $patterns;
    }
}
