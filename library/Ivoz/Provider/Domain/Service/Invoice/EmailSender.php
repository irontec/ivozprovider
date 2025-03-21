<?php

namespace Ivoz\Provider\Domain\Service\Invoice;

use Ivoz\Core\Domain\Service\EntityTools;
use Ivoz\Core\Domain\Model\Mailer\Message;
use Ivoz\Core\Domain\Service\MailerClientInterface;
use Ivoz\Provider\Domain\Model\Invoice\InvoiceDto;
use Ivoz\Provider\Domain\Model\Invoice\InvoiceInterface;
use Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateRepository;
use Ivoz\Provider\Domain\Model\NotificationTemplateContent\NotificationTemplateContentInterface;

class EmailSender implements InvoiceLifecycleEventHandlerInterface
{
    public const ON_COMMIT_PRIORITY = InvoiceLifecycleEventHandlerInterface::PRIORITY_LOW;

    public function __construct(
        private EntityTools $entityTools,
        private MailerClientInterface $mailer,
        private NotificationTemplateRepository $notificationTemplateRepository
    ) {
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_ON_COMMIT => self::ON_COMMIT_PRIORITY
        ];
    }

    public function execute(InvoiceInterface $invoice): void
    {
        $targetEmail = $this->getTargetEmail($invoice);
        if (!$targetEmail) {
            return;
        }

        $notificationTemplateContent = $this->getNotificationTemplateContent($invoice);
        if (!$notificationTemplateContent) {
            return;
        }

        // Get data from template
        $fromName = $notificationTemplateContent->getFromName();
        $fromAddress = $notificationTemplateContent->getFromAddress();
        $bodyType = $notificationTemplateContent->getBodyType();
        $body = $this->parseVariables(
            $invoice,
            $notificationTemplateContent->getBody()
        );
        $subject = $this->parseVariables(
            $invoice,
            $notificationTemplateContent->getSubject()
        );

        /** @var InvoiceDto $invoiceDto */
        $invoiceDto = $this->entityTools->entityToDto($invoice);
        $pdfPath = $invoiceDto->getPdfPath();
        if (is_null($pdfPath)) {
            throw new \RuntimeException(
                'Empty pdf path found'
            );
        }

        // Create a new mail and attach the PDF file
        $message = new Message();
        $message->setBody($body, $bodyType)
            ->setSubject($subject)
            ->setFromAddress((string) $fromAddress)
            ->setFromName((string) $fromName)
            ->setToAddress($targetEmail);

        $message->setAttachment(
            $pdfPath,
            $invoiceDto->getPdfBaseName(),
            'application/pdf',
        );

        // Send the email
        $this->mailer->send(
            $message
        );
    }

    private function getTargetEmail(InvoiceInterface $invoice): ?string
    {
        if (!$invoice->hasChanged('status')) {
            return null;
        }

        if ($invoice->getStatus() !== 'created') {
            return null;
        }

        $scheduler = $invoice->getScheduler();
        if (!$scheduler) {
            return null;
        }

        $email = $scheduler->getEmail();
        if (empty($email)) {
            return null;
        }

        return $email;
    }

    private function getNotificationTemplateContent(InvoiceInterface $invoice): ?NotificationTemplateContentInterface
    {
        $company = $invoice->getCompany();

        $invoiceNotificationTemplate = $this
            ->notificationTemplateRepository
            ->findInvoiceNotificationTemplateByCompany($company);

        // Get Notification contents for required language
        return $invoiceNotificationTemplate->getContentsByLanguage(
            $company->getLanguage()
        );
    }

    /**
     * @param InvoiceInterface $invoice
     * @param string $content
     * @return string
     */
    private function parseVariables(InvoiceInterface $invoice, string $content): string
    {
        $company = $invoice->getCompany();
        $timezone = $company->getDefaultTimezone();
        $dateTimeZone = new \DateTimeZone($timezone->getTz());

        $inDate = $invoice
            ->getInDate()
            ->setTimezone($dateTimeZone);

        $outDate = $invoice
            ->getOutDate()
            ->setTimezone($dateTimeZone);

        $substitution = [
            '${INVOICE_COMPANY}' => $company->getName(),
            '${INVOICE_DATE_IN}' => $inDate->format('Y-m-d'),
            '${INVOICE_DATE_OUT}' => $outDate->format('Y-m-d'),
            '${INVOICE_AMOUNT}' => $invoice->getTotalWithTax(),
            '${INVOICE_CURRENCY}' => $company->getCurrencySymbol()
        ];

        return str_replace(
            array_keys($substitution),
            array_values($substitution),
            $content
        );
    }
}
