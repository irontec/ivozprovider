<?php

namespace Ivoz\Provider\Domain\Service\NotificationTemplateContent;

use Ivoz\Provider\Domain\Model\CallCsvReport\CallCsvReportInterface;
use Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateInterface;
use Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateRepository;

class CallCsvNotificationTemplateByCallCsvReport
{
    public function __construct(
        private NotificationTemplateRepository $notificationTemplateRepository
    ) {
    }

    /**
     * @param CallCsvReportInterface $callCsvReport
     * @return \Ivoz\Provider\Domain\Model\NotificationTemplateContent\NotificationTemplateContentInterface
     */
    public function execute(CallCsvReportInterface $callCsvReport)
    {
        $company = $callCsvReport->getCompany();
        $brand = $callCsvReport->getBrand();

        $language = $company
            ? $company->getLanguage()
            : $brand->getLanguage();

        $callCsvNotificationTemplate = $this->getNotificationTemplate($callCsvReport);
        if (!$callCsvNotificationTemplate) {
            $callCsvNotificationTemplate = $this
                ->notificationTemplateRepository
                ->findGenericCallCsvTemplate();
        }

        // Get Notification contents for required language
        $notificationTemplateContent = $callCsvNotificationTemplate->getContentsByLanguage(
            $language
        );

        return $notificationTemplateContent;
    }

    /**
     * @param CallCsvReportInterface $callCsvReport
     * @return NotificationTemplateInterface | null
     */
    private function getNotificationTemplate(CallCsvReportInterface $callCsvReport)
    {
        $company = $callCsvReport->getCompany();
        if ($company) {
            $callCsvNotificationTemplate = $company->getCallCsvNotificationTemplate();
            if (!$callCsvNotificationTemplate) {
                $brand = $company->getBrand();
                $callCsvNotificationTemplate = $brand->getCallCsvNotificationTemplate();
            }
            return $callCsvNotificationTemplate;
        }

        $scheduler = $callCsvReport
            ->getCallCsvScheduler();

        if (!$scheduler) {
            return null;
        }

        return $scheduler->getCallCsvNotificationTemplate();
    }
}
