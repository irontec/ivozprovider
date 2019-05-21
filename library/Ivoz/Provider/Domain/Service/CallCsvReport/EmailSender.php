<?php

namespace Ivoz\Provider\Domain\Service\CallCsvReport;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Core\Domain\Model\Mailer\Message;
use Ivoz\Provider\Domain\Model\CallCsvReport\CallCsvReportDto;
use Ivoz\Provider\Domain\Model\CallCsvReport\CallCsvReportInterface;
use Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateInterface;
use Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateRepository;
use Ivoz\Core\Domain\Service\MailerClientInterface;
use Ivoz\Provider\Domain\Service\NotificationTemplateContent\CallCsvNotificationTemplateByCallCsvReport;
use Psr\Log\LoggerInterface;

class EmailSender implements CallCsvReportLifecycleEventHandlerInterface
{
    const ON_COMMIT_PRIORITY = self::PRIORITY_LOW;

    /**
     * @var EntityTools
     */
    protected $entityTools;

    /**
     * @var CallCsvNotificationTemplateByCallCsvReport
     */
    protected $callCsvNotificationTemplateByCallCsvReport;

    /**
     * @var MailerClientInterface
     */
    protected $mailer;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    public function __construct(
        EntityTools $entityTools,
        CallCsvNotificationTemplateByCallCsvReport $callCsvNotificationTemplateByCallCsvReport,
        MailerClientInterface $mailer,
        LoggerInterface $logger
    ) {
        $this->entityTools = $entityTools;
        $this->callCsvNotificationTemplateByCallCsvReport = $callCsvNotificationTemplateByCallCsvReport;
        $this->mailer = $mailer;
        $this->logger = $logger;
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_ON_COMMIT => self::ON_COMMIT_PRIORITY,
        ];
    }

    /**
     * @param CallCsvReportInterface $callCsvReport
     * @return void
     * @throws \DomainException
     */
    public function execute(CallCsvReportInterface $callCsvReport)
    {
        $isNew = $callCsvReport->isNew();
        if (!$isNew) {
            return;
        }

        $scheduler = $callCsvReport->getCallCsvScheduler();
        if (!$scheduler) {
            return;
        }

        $targetEmail = $callCsvReport->getSentTo();
        if (!$targetEmail) {
            return;
        }

        $notificationTemplateContent = $this
            ->callCsvNotificationTemplateByCallCsvReport
            ->execute($callCsvReport);

        $fromName = $notificationTemplateContent->getFromName();
        $fromAddress = $notificationTemplateContent->getFromAddress();
        $body = $this->parseVariables(
            $callCsvReport,
            $notificationTemplateContent->getBody()
        );
        $subject = $this->parseVariables(
            $callCsvReport,
            $notificationTemplateContent->getSubject()
        );

        /** @var CallCsvReportDto $callCsvReportDto */
        $callCsvReportDto = $this->entityTools->entityToDto(
            $callCsvReport
        );

        $mail = new Message();
        $mail->setBody($body)
            ->setSubject($subject)
            ->setFromAddress($fromAddress)
            ->setFromName($fromName)
            ->setToAddress($targetEmail)
            ->setAttachment(
                $callCsvReportDto->getCsvPath(),
                $callCsvReportDto->getCsvBaseName(),
                'text/csv'
            );

        try {
            $this->mailer->send($mail);
        } catch (\Exception $e) {
            $errorMsg = 'Unable to send call CSV report to email: ' . $e->getMessage();
            $this->logger->error($errorMsg);

            throw new \DomainException(
                $errorMsg,
                $e->getCode(),
                $e
            );
        }
    }

    /**
     * @param CallCsvReportInterface $callCsvReport
     * @param string $content
     * @return string
     */
    private function parseVariables(CallCsvReportInterface $callCsvReport, string $content): string
    {
        $company = $callCsvReport->getCompany();
        $brand = $callCsvReport->getBrand();

        $timezone = $company
            ? $company->getDefaultTimezone()
            : $brand->getDefaultTimezone();

        $dateTimeZone = new \DateTimeZone($timezone->getTz());

        $inDate = $callCsvReport
            ->getInDate()
            ->setTimezone($dateTimeZone);

        $outDate = $callCsvReport
            ->getOutDate()
            ->setTimezone($dateTimeZone);

        $name = $company
            ? $company->getName()
            : '';

        $substitution = [
            '${CALLCSV_COMPANY}' => $name,
            '${CALLCSV_DATE_IN}' => $inDate->format('Y-m-d'),
            '${CALLCSV_DATE_OUT}' => $outDate->format('Y-m-d'),
        ];

        return str_replace(
            array_keys($substitution),
            array_values($substitution),
            $content
        );
    }
}
