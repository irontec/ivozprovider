<?php

namespace Ivoz\Provider\Domain\Service\NotificationTemplateContent;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Core\Domain\Model\Mailer\Message;
use Ivoz\Provider\Domain\Model\CallCsvReport\CallCsvReportDto;
use Ivoz\Provider\Domain\Model\CallCsvReport\CallCsvReportInterface;
use Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateInterface;
use Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateRepository;
use Ivoz\Core\Domain\Service\MailerClientInterface;
use Psr\Log\LoggerInterface;

class CallCsvNotificationTemplateByCallCsvReport
{
    /**
     * @var NotificationTemplateRepository
     */
    protected $notificationTemplateRepository;

    public function __construct(
        NotificationTemplateRepository $notificationTemplateRepository
    ) {
        $this->notificationTemplateRepository = $notificationTemplateRepository;
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
            return $company->getCallCsvNotificationTemplate();
        }

        $scheduler = $callCsvReport
            ->getCallCsvScheduler();

        if (!$scheduler) {
            return null;
        }

        return $scheduler->getCallCsvNotificationTemplate();
    }
}
