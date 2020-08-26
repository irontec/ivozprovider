<?php

namespace Ivoz\Provider\Domain\Model\NotificationTemplate;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Common\Collections\ArrayCollection;

interface NotificationTemplateInterface extends LoggableEntityInterface
{
    const TYPE_VOICEMAIL = 'voicemail';
    const TYPE_FAX = 'fax';
    const TYPE_LIMIT = 'limit';
    const TYPE_LOWBALANCE = 'lowbalance';
    const TYPE_INVOICE = 'invoice';
    const TYPE_CALLCSV = 'callCsv';
    const TYPE_MAXDAILYUSAGE = 'maxDailyUsage';


    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * Get contents by language
     *
     * @param \Ivoz\Provider\Domain\Model\Language\LanguageInterface $language
     * @return \Ivoz\Provider\Domain\Model\NotificationTemplateContent\NotificationTemplateContentInterface | null
     */
    public function getContentsByLanguage(\Ivoz\Provider\Domain\Model\Language\LanguageInterface $language);

    /**
     * Get name
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Get type
     *
     * @return string
     */
    public function getType(): string;

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

    /**
     * Add content
     *
     * @param \Ivoz\Provider\Domain\Model\NotificationTemplateContent\NotificationTemplateContentInterface $content
     *
     * @return static
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
     * @param ArrayCollection $contents of Ivoz\Provider\Domain\Model\NotificationTemplateContent\NotificationTemplateContentInterface
     * @return static
     */
    public function replaceContents(ArrayCollection $contents);

    /**
     * Get contents
     * @param Criteria | null $criteria
     * @return \Ivoz\Provider\Domain\Model\NotificationTemplateContent\NotificationTemplateContentInterface[]
     */
    public function getContents(\Doctrine\Common\Collections\Criteria $criteria = null);
}
