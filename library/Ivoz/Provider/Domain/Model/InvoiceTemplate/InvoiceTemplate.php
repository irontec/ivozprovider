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
     * @return array<string, mixed>
     */
    public function getChangeSet(): array
    {
        return parent::getChangeSet();
    }

    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    protected function sanitizeValues(): void
    {
        $notNew = !$this->isNew();
        $brandHasChanged = $this->hasChanged('brandId');

        if ($notNew && $brandHasChanged) {
            $errorMsg = $this->getBrand()
                ? 'Unable to convert a global invoice template into a brand invoice template'
                : 'Unable to convert a brand invoice template into a global invoice template';

            throw new \DomainException($errorMsg, 403);
        }
    }

    /**
     * @inheritdoc
     */
    public function setTemplate(string $template): static
    {
        if (empty($template)) {
            throw new \DomainException('Template cannot be empty', 80000);
        }

        return parent::setTemplate(...func_get_args());
    }
}
