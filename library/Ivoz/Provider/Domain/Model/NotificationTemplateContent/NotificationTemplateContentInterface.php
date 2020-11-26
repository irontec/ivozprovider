<?php

namespace Ivoz\Provider\Domain\Model\NotificationTemplateContent;

use Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateInterface;
use Ivoz\Provider\Domain\Model\Language\LanguageInterface;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;

/**
* NotificationTemplateContentInterface
*/
interface NotificationTemplateContentInterface extends LoggableEntityInterface
{
    const BODYTYPE_TEXTPLAIN = 'text/plain';

    const BODYTYPE_TEXTHTML = 'text/html';

    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * Get fromName
     *
     * @return string | null
     */
    public function getFromName(): ?string;

    /**
     * Get fromAddress
     *
     * @return string | null
     */
    public function getFromAddress(): ?string;

    /**
     * Get subject
     *
     * @return string
     */
    public function getSubject(): string;

    /**
     * Get body
     *
     * @return string
     */
    public function getBody(): string;

    /**
     * Get bodyType
     *
     * @return string
     */
    public function getBodyType(): string;

    /**
     * Set notificationTemplate
     *
     * @param NotificationTemplateInterface
     *
     * @return static
     */
    public function setNotificationTemplate(NotificationTemplateInterface $notificationTemplate): NotificationTemplateContentInterface;

    /**
     * Get notificationTemplate
     *
     * @return NotificationTemplateInterface
     */
    public function getNotificationTemplate(): NotificationTemplateInterface;

    /**
     * Get language
     *
     * @return LanguageInterface | null
     */
    public function getLanguage(): ?LanguageInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

}
