<?php

namespace Ivoz\Provider\Domain\Model\NotificationTemplate;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Doctrine\Common\Collections\Collection;

interface NotificationTemplateInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * Get contents by language
     *
     * @param LanguageInterface $language
     * @return \Ivoz\Provider\Domain\Model\NotificationTemplateContent\NotificationTemplateContentInterface
     */
    public function getContentsByLanguage(\Ivoz\Provider\Domain\Model\Language\LanguageInterface $language);

    /**
     * Get name
     *
     * @return string
     */
    public function getName();

    /**
     * Get type
     *
     * @return string
     */
    public function getType();

    /**
     * Set brand
     *
     * @param \Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand
     *
     * @return self
     */
    public function setBrand(\Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand = null);

    /**
     * Get brand
     *
     * @return \Ivoz\Provider\Domain\Model\Brand\BrandInterface | null
     */
    public function getBrand();

    /**
     * Add content
     *
     * @param \Ivoz\Provider\Domain\Model\NotificationTemplateContent\NotificationTemplateContentInterface $content
     *
     * @return NotificationTemplateTrait
     */
    public function addContent(\Ivoz\Provider\Domain\Model\NotificationTemplateContent\NotificationTemplateContentInterface $content);

    /**
     * Remove content
     *
     * @param \Ivoz\Provider\Domain\Model\NotificationTemplateContent\NotificationTemplateContentInterface $content
     */
    public function removeContent(\Ivoz\Provider\Domain\Model\NotificationTemplateContent\NotificationTemplateContentInterface $content);

    /**
     * Replace contents
     *
     * @param \Ivoz\Provider\Domain\Model\NotificationTemplateContent\NotificationTemplateContentInterface[] $contents
     * @return self
     */
    public function replaceContents(Collection $contents);

    /**
     * Get contents
     *
     * @return \Ivoz\Provider\Domain\Model\NotificationTemplateContent\NotificationTemplateContentInterface[]
     */
    public function getContents(\Doctrine\Common\Collections\Criteria $criteria = null);
}
