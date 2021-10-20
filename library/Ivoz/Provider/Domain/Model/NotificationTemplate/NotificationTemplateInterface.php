<?php

namespace Ivoz\Provider\Domain\Model\NotificationTemplate;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Provider\Domain\Model\Language\LanguageInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\NotificationTemplateContent\NotificationTemplateContentInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;

/**
* NotificationTemplateInterface
*/
interface NotificationTemplateInterface extends LoggableEntityInterface
{
    public const TYPE_VOICEMAIL = 'voicemail';

    public const TYPE_FAX = 'fax';

    public const TYPE_LIMIT = 'limit';

    public const TYPE_LOWBALANCE = 'lowbalance';

    public const TYPE_INVOICE = 'invoice';

    public const TYPE_CALLCSV = 'callCsv';

    public const TYPE_MAXDAILYUSAGE = 'maxDailyUsage';

    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet(): array;

    /**
     * Get contents by language
     *
     * @param \Ivoz\Provider\Domain\Model\Language\LanguageInterface $language
     * @return \Ivoz\Provider\Domain\Model\NotificationTemplateContent\NotificationTemplateContentInterface | null
     */
    public function getContentsByLanguage(LanguageInterface $language);

    public function getName(): string;

    public function getType(): string;

    public function getBrand(): ?BrandInterface;

    public function isInitialized(): bool;

    public function addContent(NotificationTemplateContentInterface $content): NotificationTemplateInterface;

    public function removeContent(NotificationTemplateContentInterface $content): NotificationTemplateInterface;

    public function replaceContents(ArrayCollection $contents): NotificationTemplateInterface;

    public function getContents(?Criteria $criteria = null): array;
}
