<?php

namespace Ivoz\Provider\Domain\Model\NotificationTemplateContent;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateInterface;
use Ivoz\Provider\Domain\Model\Language\LanguageInterface;

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

    public function getFromName(): ?string;

    public function getFromAddress(): ?string;

    public function getSubject(): string;

    public function getBody(): string;

    public function getBodyType(): string;

    public function setNotificationTemplate(NotificationTemplateInterface $notificationTemplate): static;

    public function getNotificationTemplate(): NotificationTemplateInterface;

    public function getLanguage(): ?LanguageInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;
}
