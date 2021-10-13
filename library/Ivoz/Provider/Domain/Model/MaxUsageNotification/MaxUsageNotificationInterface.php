<?php

namespace Ivoz\Provider\Domain\Model\MaxUsageNotification;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;

/**
* MaxUsageNotificationInterface
*/
interface MaxUsageNotificationInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet(): array;

    public function getToAddress(): ?string;

    public function getThreshold(): ?float;

    /**
     * @return \DateTime|\DateTimeImmutable
     */
    public function getLastSent(): ?\DateTimeInterface;

    public function getNotificationTemplate(): ?NotificationTemplateInterface;

    public function getCompany(): ?CompanyInterface;

    public function isInitialized(): bool;
}
