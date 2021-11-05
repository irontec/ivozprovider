<?php

namespace Ivoz\Provider\Domain\Model\NotificationTemplate;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Persistence\ObjectRepository;
use Ivoz\Provider\Domain\Model\BalanceNotification\BalanceNotificationInterface;
use Ivoz\Provider\Domain\Model\CallCsvReport\CallCsvReportInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Language\LanguageInterface;

interface NotificationTemplateRepository extends ObjectRepository, Selectable
{
    public function findCallCsvTemplateByCallCsvReport(CallCsvReportInterface $callCsvReport): NotificationTemplateInterface;

    public function findInvoiceNotificationTemplateByCompany(CompanyInterface $company): NotificationTemplateInterface;

    public function findFaxTemplateByCompany(CompanyInterface $company): NotificationTemplateInterface;

    public function findMaxDailyUsageTemplateByCompany(CompanyInterface $company): NotificationTemplateInterface;

    public function findVoicemailTemplateByCompany(CompanyInterface $company, LanguageInterface $language): NotificationTemplateInterface;

    public function findTemplateByBalanceNotification(BalanceNotificationInterface $balanceNotification, LanguageInterface $language): NotificationTemplateInterface;
}
