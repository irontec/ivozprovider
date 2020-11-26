<?php

namespace Ivoz\Provider\Domain\Model\InvoiceTemplate;

use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;

/**
* InvoiceTemplateInterface
*/
interface InvoiceTemplateInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * @inheritdoc
     */
    public function setTemplate(string $template): InvoiceTemplateInterface;

    /**
     * Get name
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Get description
     *
     * @return string | null
     */
    public function getDescription(): ?string;

    /**
     * Get template
     *
     * @return string
     */
    public function getTemplate(): string;

    /**
     * Get templateHeader
     *
     * @return string | null
     */
    public function getTemplateHeader(): ?string;

    /**
     * Get templateFooter
     *
     * @return string | null
     */
    public function getTemplateFooter(): ?string;

    /**
     * Get brand
     *
     * @return BrandInterface | null
     */
    public function getBrand(): ?BrandInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

}
