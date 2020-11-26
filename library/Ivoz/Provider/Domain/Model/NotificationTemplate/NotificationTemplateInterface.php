<?php

namespace Ivoz\Provider\Domain\Model\NotificationTemplate;

use Ivoz\Provider\Domain\Model\Language\LanguageInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\NotificationTemplateContent\NotificationTemplateContentInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;

/**
* NotificationTemplateInterface
*/
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
    public function getContentsByLanguage(LanguageInterface $language);

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
     * @return BrandInterface | null
     */
    public function getBrand(): ?BrandInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

    /**
     * Add content
     *
     * @param NotificationTemplateContentInterface $content
     *
     * @return static
     */
    public function addContent(NotificationTemplateContentInterface $content): NotificationTemplateInterface;

    /**
     * Remove content
     *
     * @param NotificationTemplateContentInterface $content
     *
     * @return static
     */
    public function removeContent(NotificationTemplateContentInterface $content): NotificationTemplateInterface;

    /**
     * Replace contents
     *
     * @param ArrayCollection $contents of NotificationTemplateContentInterface
     *
     * @return static
     */
    public function replaceContents(ArrayCollection $contents): NotificationTemplateInterface;

    /**
     * Get contents
     * @param Criteria | null $criteria
     * @return NotificationTemplateContentInterface[]
     */
    public function getContents(?Criteria $criteria = null): array;

}
