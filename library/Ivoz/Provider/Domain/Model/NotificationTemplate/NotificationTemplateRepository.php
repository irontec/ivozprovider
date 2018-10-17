<?php

namespace Ivoz\Provider\Domain\Model\NotificationTemplate;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;
use Ivoz\Provider\Domain\Model\BalanceNotification\BalanceNotificationInterface;

interface NotificationTemplateRepository extends ObjectRepository, Selectable
{
    /**
     * @return null | NotificationTemplateInterface
     */
    public function findGenericCallCsvTemplate();

    /**
     * @return null | NotificationTemplateInterface
     */
    public function findGenericInvoiceTemplate();

    /**
     * @return null | NotificationTemplateInterface
     */
    public function findGenericFaxTemplate();

    /**
     * @return null | NotificationTemplateInterface
     */
    public function findGenericVoicemailTemplate();

    /**
     * @param BalanceNotificationInterface $balanceNotification
     * @return \Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateInterface|null|object
     */
    public function findTemplateByBalanceNotification(BalanceNotificationInterface $balanceNotification);
}
