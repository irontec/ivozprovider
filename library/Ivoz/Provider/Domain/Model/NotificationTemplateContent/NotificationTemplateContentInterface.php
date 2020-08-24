<?php

namespace Ivoz\Provider\Domain\Model\NotificationTemplateContent;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

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
    public function getFromName();

    /**
     * Get fromAddress
     *
     * @return string | null
     */
    public function getFromAddress();

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
     * @param \Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateInterface $notificationTemplate
     *
     * @return static
     */
    public function setNotificationTemplate(\Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateInterface $notificationTemplate);

    /**
     * Get notificationTemplate
     *
     * @return \Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateInterface
     */
    public function getNotificationTemplate();

    /**
     * Get language
     *
     * @return \Ivoz\Provider\Domain\Model\Language\LanguageInterface | null
     */
    public function getLanguage();

    /**
     * @return bool
     */
    public function isInitialized(): bool;
}
