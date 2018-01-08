<?php
namespace Agi\Action;

use Agi\Wrapper;
use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Provider\Domain\Model\FaxesInOut\FaxesInOutDTO;
use Ivoz\Provider\Domain\Model\FaxesInOut\FaxesInOutInterface;


class FaxReceiveStatusAction
{
    /**
     * @var Wrapper
     */
    protected $agi;

    /**
     * @var EntityPersisterInterface
     */
    protected $entityPersister;

    /**
     * @var \Swift_Mailer
     */
    protected $mailer;

    /**
     * @var string
     */
    protected $fromName;

    /**
     * @var string
     */
    protected $fromAdress;

    /**
     * @var FaxesInOutInterface
     */
    protected $faxInOut;


    public function __construct(
        Wrapper $agi,
        EntityPersisterInterface $entityPersister,
        \Swift_Mailer $mailer,
        string $fromName,
        string $fromAdress
    )
    {
        $this->agi = $agi;
        $this->entityPersister = $entityPersister;
        $this->mailer = $mailer;
        $this->fromName = $fromName;
        $this->fromAdress = $fromAdress;
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
        if (is_null($faxIn)) {
            $this->agi->error("Faxfile has no Fax associated! Check configuration.");
            return;
        }

        // Get DTO for status updates
        /** @var FaxesInOutDTO $faxInDto */
        $faxInDto = $faxIn->toDTO();

        // Check no errors happened during ReceiveFax
        $error = $this->agi->getVariable("FAXOPT(error)");
        $statusstr = $this->agi->getVariable("FAXOPT(statusstr)");

        if (! empty($error) && $statusstr != "OK") {
            // Show error message in asterisk CLI
            $this->agi->error("Error receiving fax: $statusstr ($error)");
            // Mark this fax as error and save
            $faxInDto->setStatus('error');
            $this->entityPersister->persistDto($faxInDto, $faxIn);
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
            $this->entityPersister->persistDto($faxInDto, $faxIn);
            return;
        }

        // Some asterisk cli output
        $this->agi->verbose("Converting Fax [faxInOut%d] [fax%d] TIFF to PDF", $faxIn->getId(), $fax->getId());

        // Convert TIFF file to PDF before storing
        shell_exec("/usr/bin/tiff2pdf -o $faxPdfPath $faxTIF 2>/dev/null");

        // TODO Check return value for errors (use exec instead of shell_exec?)
        // Remove received tif file after conversion
        unlink($faxTIF);

        $faxPdfName = sprintf("fax-%s-%s.pdf", $faxInDto->getSrc(), $faxInDto->getDst());
        $faxPdfPages = $this->agi->getVariable("FAXOPT(pages)");

        // Success!!
        $faxInDto
            ->setStatus('completed')
            ->setPages($faxPdfPages)
            ->setFilePath($faxPdfPath)
            ->setFileBaseName($faxPdfName);

        $this->entityPersister->persistDto($faxInDto, $faxIn);

        $this->agi->verbose("Fax [faxInOut%d] completed (%d pages)", $faxIn->getId(), $faxIn->getPages());

        // Check if this fax is associated with an email address
        if ($fax->getSendByEmail()) {
            $this->agi->notice("Sending Fax [faxInOut%d] to %s", $faxIn->getId(), $fax->getEmail());

            // Get Fax Company
            $company = $fax->getCompany();

            // Create attachment for PDF file
            $attach = \Swift_Attachment::fromPath($faxPdfPath, 'application/pdf');

            // Override default FromName
            $fromName = $company->getBrand()->getFromName();
            if (!empty($fromName)) {
                $this->fromName = $fromName;
            }

            // Override default FromAdress
            $fromAddress = $company->getBrand()->getFromAddress();
            if (!empty($fromAddress)) {
                $this->fromAdress = $fromAddress;
            }

            // Get faxdata values for mail message body and subject
            $substitution = array(
                    '${FAX_NAME}'       => $fax->getName(),
                    '${FAX_PDFNAME}'    => $faxIn->getPages(),
                    '${FAX_SRC}'        => $faxIn->getSrc(),
                    '${FAX_DST}'        => $faxIn->getDst(),
                    '${FAX_DATE}'       => $faxIn->getCalldate(),
                    '${FAX_PAGES}'      => $faxIn->getPages(),
            );

            // Read configured template
            $templateDir = APPLICATION_PATH . "/../templates/faxmail/default/" . $company->getLanguageCode() . "/";
            $body = file_get_contents($templateDir . "body");
            $subject = file_get_contents($templateDir . "subject");

            foreach ($substitution as $search => $replace) {
                $body = str_replace($search, $replace, $body);
                $subject = str_replace($search, $replace, $subject);
            }

            // Create a new mail and attach the PDF file
            $mail = new \Swift_Message();
            $mail->setBody($body)
                ->setSubject($subject)
                ->setFrom($this->fromAdress, $this->fromName)
                ->setTo($fax->getEmail())
                ->attach($attach);

            // Send the email
            $this->mailer->send($mail);
        }

    }
}
