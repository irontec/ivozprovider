<?php

namespace Ivoz\Provider\Domain\Model\InvoiceTemplate;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

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
    public function setTemplate($template);

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
    public function getDescription();

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
    public function getTemplateHeader();

    /**
     * Get templateFooter
     *
     * @return string | null
     */
    public function getTemplateFooter();

    /**
     * Get brand
     *
     * @return \Ivoz\Provider\Domain\Model\Brand\BrandInterface | null
     */
    public function getBrand();

    /**
     * @return bool
     */
    public function isInitialized(): bool;
}
