<?php

namespace Ivoz\Provider\Domain\Model\TerminalModel;

use Assert\Assertion;

/**
 * TerminalModel
 */
class TerminalModel extends TerminalModelAbstract implements TerminalModelInterface
{
    use TerminalModelTrait;

    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet()
    {
        return parent::getChangeSet();
    }

    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritDoc}
     */
    public function setIden($iden)
    {
        Assertion::regex($iden, '/^[a-zA-Z0-9_-]+$/');
        return parent::setIden($iden);
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
     * @param string $template
     * @return string
     *
     * Ensures that template lines don't end with a php close tag: ?>
     */
    protected function _sanitizeTemplate($template)
    {
        return preg_replace('/\?>\r\n/', "?> \r\n", $template);
    }
}
