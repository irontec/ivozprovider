<?php

namespace Ivoz\Provider\Domain\Model\BalanceNotification;

use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Carrier\CarrierInterface;
use Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateInterface;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;

/**
* BalanceNotificationInterface
*/
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
     * Get company
     *
     * @return CompanyInterface | null
     */
    public function getCompany(): ?CompanyInterface;

    /**
     * Get carrier
     *
     * @return CarrierInterface | null
     */
    public function getCarrier(): ?CarrierInterface;

    /**
     * Get notificationTemplate
     *
     * @return NotificationTemplateInterface | null
     */
    public function getNotificationTemplate(): ?NotificationTemplateInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

}
