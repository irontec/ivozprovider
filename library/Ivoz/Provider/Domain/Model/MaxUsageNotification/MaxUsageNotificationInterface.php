<?php

namespace Ivoz\Provider\Domain\Model\MaxUsageNotification;

use Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;

/**
* MaxUsageNotificationInterface
*/
interface MaxUsageNotificationInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * Get toAddress
     *
     * @return string | null
     */
    public function getToAddress(): ?string;

    /**
     * Get threshold
     *
     * @return float | null
     */
    public function getThreshold(): ?float;

    /**
     * Get lastSent
     *
     * @return \DateTimeInterface | null
     */
    public function getLastSent(): ?\DateTimeInterface;

    /**
     * Get notificationTemplate
     *
     * @return NotificationTemplateInterface | null
     */
    public function getNotificationTemplate(): ?NotificationTemplateInterface;

    /**
     * Get company
     *
     * @return CompanyInterface | null
     */
    public function getCompany(): ?CompanyInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

}
