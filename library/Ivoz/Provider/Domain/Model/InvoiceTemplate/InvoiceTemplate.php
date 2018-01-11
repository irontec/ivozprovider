<?php
namespace Ivoz\Provider\Domain\Model\InvoiceTemplate;

/**
 * InvoiceTemplate
 */
class InvoiceTemplate extends InvoiceTemplateAbstract implements InvoiceTemplateInterface
{
    use InvoiceTemplateTrait;

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
     * @inheritdoc
     */
    public function setTemplate($template)
    {
        if (empty($template)) {
            throw new \Exception('Template cannot be empty', 80000);
        }

        return parent::setTemplate(...func_get_args());
    }
}

