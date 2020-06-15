<?php

namespace Ivoz\Provider\Domain\Model\BalanceNotification;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

interface BalanceNotificationInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * @return \Ivoz\Provider\Domain\Model\Language\LanguageInterface | null
     */
    public function getLanguage();

    /**
     * @return string
     */
    public function getEntityName();

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
     * Get carrier
     *
     * @return \Ivoz\Provider\Domain\Model\Carrier\CarrierInterface | null
     */
    public function getCarrier();

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
