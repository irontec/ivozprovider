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
class MatchLists extends Raw\MatchLists
{
    /**
     * This method is called just after parent's constructor
     */
    public function init()
    {
    }



    /**
     * Check if the given number matches the list rules
     *
     * @param string $number in E164 form
     * @return true if number matches, false otherwise
     */
    public function numberMatches($number)
    {
        // Get patterns
        $patterns = $this->getMatchListPatterns();

        foreach ($patterns as $pattern) {
            switch ($pattern->getType()) {
                case 'number':
                    if ($pattern->getNumberE164() == $number) {
                        return true;
                    }
                    break;
                case 'regexp':
                    $regexp = $pattern->getRegExp();
                    $match = preg_match('/' . $regexp . '/', $number);
                    if ($match) {
                        return true;
                    }
                    break;
            }
        }

        return false;
    }
}
