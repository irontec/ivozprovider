<?php

namespace Ivoz\Provider\Domain\Model\BalanceNotification;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Carrier\CarrierInterface;
use Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateInterface;

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

    public function getToAddress(): ?string;

    public function getThreshold(): ?float;

    public function getLastSent(): ?\DateTime;

    public function getCompany(): ?CompanyInterface;

    public function getCarrier(): ?CarrierInterface;

    public function getNotificationTemplate(): ?NotificationTemplateInterface;

    public function isInitialized(): bool;
}
