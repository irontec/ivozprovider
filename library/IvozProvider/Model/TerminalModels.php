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
class TerminalModels extends Raw\TerminalModels
{
    /**
     * This method is called just after parent's constructor
     */
    public function init()
    {
    }

    /**
     * {@inheritdoc}
     */
    public function setGenericTemplate($data)
    {
        return parent::setGenericTemplate(
            $this->_sanitizeTemplate($data)
        );
    }

    /**
     * {@inheritdoc}
     */
    public function setSpecificTemplate($data)
    {
        return parent::setSpecificTemplate(
            $this->_sanitizeTemplate($data)
        );
    }

    /**
     * @param $template string
     * @return string
     *
     * Ensures that template lines don't end with a php close tag: ?>
     */
    protected function _sanitizeTemplate($template)
    {
        return preg_replace('/\?>\r\n/', "?> \r\n", $template);
    }
}
