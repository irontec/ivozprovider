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
     * @return LanguageInterface | null
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
     * @return string | null
     */
    public function getThreshold();

    /**
     * Get lastSent
     *
     * @return \DateTime | null
     */
    public function getLastSent();

    /**
     * Set company
     *
     * @param \Ivoz\Provider\Domain\Model\Company\CompanyInterface $company
     *
     * @return self
     */
    public function setCompany(\Ivoz\Provider\Domain\Model\Company\CompanyInterface $company = null);

    /**
     * Get company
     *
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyInterface | null
     */
    public function getCompany();

    /**
     * Set carrier
     *
     * @param \Ivoz\Provider\Domain\Model\Carrier\CarrierInterface $carrier
     *
     * @return self
     */
    public function setCarrier(\Ivoz\Provider\Domain\Model\Carrier\CarrierInterface $carrier = null);

    /**
     * Get carrier
     *
     * @return \Ivoz\Provider\Domain\Model\Carrier\CarrierInterface | null
     */
    public function getCarrier();

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
     * @return \Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateInterface | null
     */
    public function getNotificationTemplate();
}
