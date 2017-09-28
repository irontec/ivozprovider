<?php
namespace Ivoz\Provider\Domain\Model\InvoiceTemplate;

/**
 * InvoiceTemplate
 */
class InvoiceTemplate extends InvoiceTemplateAbstract implements InvoiceTemplateInterface
{
    use InvoiceTemplateTrait;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}

