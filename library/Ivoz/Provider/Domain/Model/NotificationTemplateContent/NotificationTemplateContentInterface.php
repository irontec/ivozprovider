<?php

namespace Ivoz\Provider\Domain\Model\NotificationTemplateContent;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

interface NotificationTemplateContentInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * @deprecated
     * Set fromName
     *
     * @param string $fromName
     *
     * @return self
     */
    public function setFromName($fromName = null);

    /**
     * Get fromName
     *
     * @return string
     */
    public function getFromName();

    /**
     * @deprecated
     * Set fromAddress
     *
     * @param string $fromAddress
     *
     * @return self
     */
    public function setFromAddress($fromAddress = null);

    /**
     * Get fromAddress
     *
     * @return string
     */
    public function getFromAddress();

    /**
     * @deprecated
     * Set subject
     *
     * @param string $subject
     *
     * @return self
     */
    public function setSubject($subject);

    /**
     * Get subject
     *
     * @return string
     */
    public function getSubject();

    /**
     * @deprecated
     * Set body
     *
     * @param string $body
     *
     * @return self
     */
    public function setBody($body);

    /**
     * Get body
     *
     * @return string
     */
    public function getBody();

    /**
     * Set notificationTemplate
     *
     * @param \Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateInterface $notificationTemplate
     *
     * @return self
     */
    public function setNotificationTemplate(\Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateInterface $notificationTemplate = null);

    /**
     * Get notificationTemplate
     *
     * @return \Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateInterface
     */
    public function getNotificationTemplate();

    /**
     * Set language
     *
     * @param \Ivoz\Provider\Domain\Model\Language\LanguageInterface $language
     *
     * @return self
     */
    public function setLanguage(\Ivoz\Provider\Domain\Model\Language\LanguageInterface $language = null);

    /**
     * Get language
     *
     * @return \Ivoz\Provider\Domain\Model\Language\LanguageInterface
     */
    public function getLanguage();

}

