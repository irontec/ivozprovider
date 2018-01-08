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

    public function __toString();

    /**
     * Set name
     *
     * @param string $name
     *
     * @return self
     */
    public function setName($name);

    /**
     * Get name
     *
     * @return string
     */
    public function getName();

    /**
     * Set description
     *
     * @param string $description
     *
     * @return self
     */
    public function setDescription($description = null);

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription();

    /**
     * Set template
     *
     * @param string $template
     *
     * @return self
     */
    public function setTemplate($template);

    /**
     * Get template
     *
     * @return string
     */
    public function getTemplate();

    /**
     * Set templateHeader
     *
     * @param string $templateHeader
     *
     * @return self
     */
    public function setTemplateHeader($templateHeader = null);

    /**
     * Get templateHeader
     *
     * @return string
     */
    public function getTemplateHeader();

    /**
     * Set templateFooter
     *
     * @param string $templateFooter
     *
     * @return self
     */
    public function setTemplateFooter($templateFooter = null);

    /**
     * Get templateFooter
     *
     * @return string
     */
    public function getTemplateFooter();

    /**
     * Set brand
     *
     * @param \Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand
     *
     * @return self
     */
    public function setBrand(\Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand);

    /**
     * Get brand
     *
     * @return \Ivoz\Provider\Domain\Model\Brand\BrandInterface
     */
    public function getBrand();

}

