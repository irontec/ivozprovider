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
     * Set toAddress
     *
     * @param string $toAddress
     *
     * @return self
     */
    public function setToAddress($toAddress = null);

    /**
     * Get toAddress
     *
     * @return string
     */
    public function getToAddress();

    /**
     * Set threshold
     *
     * @param string $threshold
     *
     * @return self
     */
    public function setThreshold($threshold = null);

    /**
     * Get threshold
     *
     * @return string
     */
    public function getThreshold();

    /**
     * Set lastSent
     *
     * @param \DateTime $lastSent
     *
     * @return self
     */
    public function setLastSent($lastSent = null);

    /**
     * Get lastSent
     *
     * @return \DateTime
     */
    public function getLastSent();

    /**
     * Set company
     *
     * @param \Ivoz\Provider\Domain\Model\Company\CompanyInterface $company
     *
     * @return self
     */
    public function setCompany(\Ivoz\Provider\Domain\Model\Company\CompanyInterface $company);

    /**
     * Get company
     *
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyInterface
     */
    public function getCompany();

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

}

