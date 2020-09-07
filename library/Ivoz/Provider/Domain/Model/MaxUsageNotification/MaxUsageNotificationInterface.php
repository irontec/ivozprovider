<?php

namespace Ivoz\Provider\Domain\Model\MaxUsageNotification;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

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
    public function getToAddress();

    /**
     * Get threshold
     *
     * @return float | null
     */
    public function getThreshold();

    /**
     * Get lastSent
     *
     * @return \DateTime | null
     */
    public function getLastSent();

    /**
     * Get company
     *
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyInterface | null
     */
    public function getCompany();

    /**
     * Get notificationTemplate
     *
     * @return \Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateInterface | null
     */
    public function getNotificationTemplate();

    /**
     * @return bool
     */
    public function isInitialized(): bool;
}
