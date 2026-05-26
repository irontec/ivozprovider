<?php

namespace Ivoz\Provider\Domain\Service\Recording;

use Ivoz\Core\Domain\Model\Mailer\Message;
use Ivoz\Core\Domain\Service\EntityTools;
use Ivoz\Core\Domain\Service\MailerClientInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateRepository;
use Ivoz\Provider\Domain\Model\Recording\RecordingDto;
use Ivoz\Provider\Domain\Model\Recording\RecordingInterface;
use Psr\Log\LoggerInterface;

class SendOnDemandRecordingEmail implements RecordingLifecycleEventHandlerInterface
{
    public const POST_PERSIST_PRIORITY = self::PRIORITY_LOW;

    public function __construct(
        private EntityTools $entityTools,
        private MailerClientInterface $mailer,
        private NotificationTemplateRepository $notificationTemplateRepository,
        private LoggerInterface $logger,
    ) {
    }

    /**
     * @return array<string,int>
     */
    public static function getSubscribedEvents(): array
    {
        return [
            self::EVENT_POST_PERSIST => self::POST_PERSIST_PRIORITY,
        ];
    }

    public function execute(RecordingInterface $recording): void
    {
        if (!$recording->isNew()) {
            return;
        }

        if ($recording->getType() !== RecordingInterface::TYPE_ONDEMAND) {
            return;
        }

        $company = $recording->getCompany();
        $mode = $company->getOnDemandRecordEmail();

        if ($mode === CompanyInterface::ONDEMANDRECORDEMAIL_DISABLED) {
            return;
        }

        $target = match ($mode) {
            CompanyInterface::ONDEMANDRECORDEMAIL_USER => $recording->getUser()?->getEmail(),
            CompanyInterface::ONDEMANDRECORDEMAIL_OTHER => $company->getOnDemandRecordEmailAddress(),
            default => null,
        };

        if (empty($target)) {
            return;
        }

        $recordingId = (string) $recording->getId();

        /** @var RecordingDto $dto */
        $dto = $this->entityTools->entityToDto($recording);
        $filePath = $dto->getRecordedFilePath();

        if (!$filePath || !file_exists($filePath)) {
            $this->logger->warning(sprintf(
                '[Recording email] Skipping send for recording #%s: file not found',
                $recordingId
            ));
            return;
        }

        $template = $this->notificationTemplateRepository
            ->findOnDemandRecordTemplateByCompany($company);
        $content = $template->getContentsByLanguage($company->getLanguage());

        if (!$content) {
            $this->logger->warning(sprintf(
                '[Recording email] Skipping send for recording #%s: no template content for company language',
                $recordingId
            ));
            return;
        }

        $body = $this->parseVariables($recording, $content->getBody());
        $subject = $this->parseVariables($recording, $content->getSubject());

        $baseName = $recording->getRecordedFile()->getBaseName()
            ?? sprintf('recording-%s.mp3', $recordingId);

        $message = (new Message())
            ->setBody($body, $content->getBodyType())
            ->setSubject($subject)
            ->setFromAddress((string) $content->getFromAddress())
            ->setFromName((string) $content->getFromName())
            ->setToAddress($target);

        $message->setAttachment(
            $filePath,
            $baseName,
            $recording->getRecordedFile()->getMimeType()
        );

        try {
            $this->mailer->send($message);
        } catch (\Throwable $e) {
            $this->logger->warning(sprintf(
                '[Recording email] Failed to send for recording #%s: %s',
                $recordingId,
                $e->getMessage()
            ));
        }
    }

    private function parseVariables(RecordingInterface $recording, string $content): string
    {
        $company = $recording->getCompany();
        $timezone = $company->getDefaultTimezone()
            ?? $company->getBrand()->getDefaultTimezone();
        $dateTimeZone = new \DateTimeZone($timezone->getTz());

        $calldate = $recording->getCalldate()->setTimezone($dateTimeZone);

        $substitution = [
            '${RECORD_COMPANY}' => $company->getName(),
            '${RECORD_CALLER}' => (string) $recording->getCaller(),
            '${RECORD_CALLEE}' => (string) $recording->getCallee(),
            '${RECORD_DATE}' => $calldate->format('Y-m-d H:i:s'),
            '${RECORD_DURATION}' => (string) $recording->getDuration(),
        ];

        return str_replace(
            array_keys($substitution),
            array_values($substitution),
            $content
        );
    }
}
