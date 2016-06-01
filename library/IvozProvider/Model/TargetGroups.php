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
class TargetGroups extends Raw\TargetGroups
{
    /**
     * This method is called just after parent's constructor
     */
    public function init()
    {
    }

    /**
     * Gets dependent getTargetPatterns
     *
     * @return array The array of \IvozProvider\Model\Raw\TargetPatterns
     * @author Ivan Alonso <kaian@irontec.com>
     */
    public function getTargetPatterns()
    {
        $targetPatterns = array();

        $targetRelPatterns = $this->getTargetGroupsRelPatterns();
        foreach ($targetRelPatterns as $targetRel) {
            $targetPatterns[] = $targetRel->getTargetPattern();
        }
        return $targetPatterns;
    }
}
