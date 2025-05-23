<?php

namespace Agi\Action;

use Agi\Wrapper;
use Doctrine\ORM\EntityManagerInterface;
use Ivoz\Core\Domain\Service\EntityTools;
use Ivoz\Core\Domain\Model\Mailer\Message;
use Ivoz\Core\Domain\Service\MailerClientInterface;
use Ivoz\Provider\Domain\Model\FaxesInOut\FaxesInOutDto;
use Ivoz\Provider\Domain\Model\FaxesInOut\FaxesInOutInterface;
use Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplate;
use Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateRepository;

class FaxReceiveStatusAction
{
    /**
     * @var Wrapper
     */
    protected $agi;

    /**
     * @var EntityManagerInterface
     */
    protected $em;

    /**
     * @var EntityTools
     */
    protected $entityTools;

    /**
     * @var MailerClientInterface
     */
    protected $mailer;

    /**
     * @var FaxesInOutInterface|null
     */
    protected $faxInOut;


    public function __construct(
        Wrapper $agi,
        EntityManagerInterface $em,
        EntityTools $entityTools,
        MailerClientInterface $mailer
    ) {
        $this->agi = $agi;
        $this->em = $em;
        $this->entityTools = $entityTools;
        $this->mailer = $mailer;
    }

    /**
     * @param FaxesInOutInterface|null $faxesInOut
     * @return $this
     */
    public function setFaxInOut(FaxesInOutInterface $faxesInOut = null)
    {
        $this->faxInOut = $faxesInOut;
        return $this;
    }

    public function process()
    {
        // Local variables to improve readability
        $faxIn = $this->faxInOut;
        if (is_null($faxIn)) {
            $this->agi->error("No Faxfile found! Check configuration.");
            return;
        }

        $fax = $faxIn->getFax();

        // Get DTO for status updates
        /** @var FaxesInOutDto $faxInDto */
        $faxInDto = $this->entityTools->entityToDto($faxIn);

        // Check no errors happened during ReceiveFax
        $error = $this->agi->getVariable("FAXOPT(error)");
        $statusstr = $this->agi->getVariable("FAXOPT(statusstr)");

        if (! empty($error) && $statusstr != "OK") {
            // Show error message in asterisk CLI
            $this->agi->error("Error receiving fax: $statusstr ($error)");
            // Mark this fax as error and save
            $faxInDto->setStatus('error');
            $this->entityTools->persistDto($faxInDto, $faxIn);
            return;
        }

        // Get final PDF name
        $faxTIF = $this->agi->getVariable("FAXOPT(filename)");
        $faxPdfPath = str_replace(".tif", ".pdf", $faxTIF);
        if (! file_exists($faxTIF)) {
            // Show error message in asterisk CLI
            $this->agi->error("File $faxTIF does not exists.");
            // Mark this fax as error and save
            $faxInDto->setStatus('error');
            $this->entityTools->persistDto($faxInDto, $faxIn, true);
            return;
        }

        // Some asterisk cli output
        $this->agi->verbose("Converting file %s of %s TIFF to PDF", $faxIn, $fax);

        // Convert TIFF file to PDF before storing
        shell_exec("/usr/bin/tiff2pdf -o $faxPdfPath $faxTIF 2>/dev/null");

        // TODO Check return value for errors (use exec instead of shell_exec?)
        // Remove received tif file after conversion
        unlink($faxTIF);

        $faxPdfName = sprintf(
            "fax-%s-%s-%s.pdf",
            $faxIn->getCalldate()->format('Ymd'),
            $fax->getName(),
            ltrim($faxIn->getSrc(), '+')
        );
        $faxPdfPages = $this->agi->getVariable("FAXOPT(pages)");

        // Success!!
        $faxInDto
            ->setStatus('completed')
            ->setPages($faxPdfPages)
            ->setFilePath($faxPdfPath)
            ->setFileBaseName($faxPdfName);

        $this->entityTools->persistDto($faxInDto, $faxIn, true);
        /** @var FaxesInOutDto $faxInDto */
        $faxInDto = $this->entityTools->entityToDto($faxIn);

        $this->agi->verbose("Fax %s completed (%d pages)", $faxIn, $faxIn->getPages());

        // Check if this fax is associated with an email address
        if ($fax->getSendByEmail()) {
            $this->agi->notice("Sending Fax %s to %s", $faxIn, $fax->getEmail());

            // Get Fax Company
            $company = $fax->getCompany();
            $brand = $company->getBrand();

            // Convert dates to company timezone
            $faxInDate = $faxIn->getCalldate();
            $companyDefaultTimezone = $company->getDefaultTimezone();
            if ($companyDefaultTimezone) {
                $faxInDate->setTimezone(new \DateTimeZone($companyDefaultTimezone->getTz()));
            }

            // Get faxdata values for mail message body and subject
            $substitution = array(
                    '${FAX_NAME}'       => $fax->getName(),
                    '${FAX_PDFNAME}'    => $faxIn->getPages(),
                    '${FAX_SRC}'        => $faxIn->getSrc(),
                    '${FAX_DST}'        => $faxIn->getDst(),
                    '${FAX_DATE}'       => $faxInDate->format('Y-m-d H:i:s'),
                    '${FAX_PAGES}'      => $faxIn->getPages(),
            );

            // Get Generic Notification Template for faxes
            /** @var NotificationTemplateRepository $notificationTemplateRepository */
            $notificationTemplateRepository = $this->em->getRepository(NotificationTemplate::class);
            $faxNotificationTemplate = $notificationTemplateRepository->findFaxTemplateByCompany($company);

            // Get Notification contents for required language
            $notificationTemplateContent = $faxNotificationTemplate->getContentsByLanguage($company->getLanguage());

            // Get data from template
            $fromName = $notificationTemplateContent->getFromName();
            $fromAddress = $notificationTemplateContent->getFromAddress();
            $bodyType = $notificationTemplateContent->getBodyType();
            $body = $notificationTemplateContent->getBody();
            $subject = $notificationTemplateContent->getSubject();


            foreach ($substitution as $search => $replace) {
                $body = str_replace($search, $replace, $body);
                $subject = str_replace($search, $replace, $subject);
            }

            // Create a new mail and attach the PDF file
            $message = new Message();
            $message->setBody($body, $bodyType)
                ->setSubject($subject)
                ->setFromName((string) $fromName)
                ->setFromAddress((string) $fromAddress)
                ->setToAddress((string) $fax->getEmail());

            $faxPdfPath = $faxInDto->getFilePath();

            if (!file_exists((string) $faxPdfPath)) {
                $this->agi->error("Unable to find file %s", $faxPdfPath);
                return;
            }

            // Create attachment for PDF file
            $message->addAttachment(
                $faxPdfPath,
                $faxPdfName,
                'application/pdf'
            );

            // Send the email
            $this->mailer->send(
                $message
            );
        }
    }
}
