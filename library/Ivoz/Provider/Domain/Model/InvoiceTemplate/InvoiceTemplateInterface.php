<?php

namespace Ivoz\Provider\Domain\Model\InvoiceTemplate;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;

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
    public function setTemplate(string $template): static;

    public function getName(): string;

    public function getDescription(): ?string;

    public function getTemplate(): string;

    public function getTemplateHeader(): ?string;

    public function getTemplateFooter(): ?string;

    public function getBrand(): ?BrandInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

}
