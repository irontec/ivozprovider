<?php

namespace Ivoz\Provider\Domain\Model\TerminalModel;

/**
 * TerminalModel
 */
class TerminalModel extends TerminalModelAbstract implements TerminalModelInterface
{
    use TerminalModelTrait;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function setGenericTemplate($genericTemplate = null)
    {
        return parent::setGenericTemplate(
            $this->_sanitizeTemplate($genericTemplate)
        );
    }

    /**
     * {@inheritdoc}
     */
    public function setSpecificTemplate($specificTemplate = null)
    {
        return parent::setSpecificTemplate(
            $this->_sanitizeTemplate($specificTemplate)
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

