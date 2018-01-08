<?php

namespace Dialplan;

use Agi\Action\ExternalFaxCallAction;
use Agi\Wrapper;
use Doctrine\ORM\EntityManagerInterface;
use Ivoz\Core\Application\Service\CommonStoragePathResolver;
use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Provider\Domain\Model\FaxesInOut\FaxesInOut;
use Ivoz\Provider\Domain\Model\FaxesInOut\FaxesInOutDTO;
use Ivoz\Provider\Domain\Model\FaxesInOut\FaxesInOutInterface;
use Ivoz\Provider\Domain\Model\FaxesInOut\FaxesInOutRepository;
use RouteHandlerAbstract;
use Symfony\Component\Process\Process;

class FaxDial extends RouteHandlerAbstract
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
     * @var EntityPersisterInterface
     */
    protected $entityPersister;

    /**
     * @var CommonStoragePathResolver
     */
    protected $faxStoragePathResolver;

    /**
     * @var ExternalFaxCallAction
     */
    protected $externalFaxCallAction;

    /**
     * Dial constructor.
     * @param Wrapper $agi
     * @param EntityManagerInterface $em
     * @param EntityPersisterInterface $entityPersister
     * @param CommonStoragePathResolver $faxStoragePathResolver
     * @param ExternalFaxCallAction $externalFaxCallAction
     */
    public function __construct(
        Wrapper $agi,
        EntityManagerInterface $em,
        EntityPersisterInterface $entityPersister,
        CommonStoragePathResolver $faxStoragePathResolver,
        ExternalFaxCallAction $externalFaxCallAction
    )
    {
        $this->agi = $agi;
        $this->em = $em;
        $this->entityPersister = $entityPersister;
        $this->faxStoragePathResolver = $faxStoragePathResolver;
        $this->externalFaxCallAction = $externalFaxCallAction;
    }

    public function process()
    {
        // Get fax file object
        $faxId = $this->agi->getVariable("FAXFILE_ID");

        /** @var FaxesInOutRepository $faxInOutRepository */
        $faxInOutRepository = $this->em->getRepository(FaxesInOut::class);

        /** @var FaxesInOutInterface $faxOut */
        $faxOut = $faxInOutRepository->find($faxId);
        if (is_null($faxOut)) {
            $this->agi->error("Faxfile %d not found in database", $faxId);
            return;
        }

        // Set Company information
        $this->agi->setVariable("__COMPANYID", $faxOut->getFax()->getCompany()->getId());

        // Convert fax file from PDF to TIFF
        $pdfFile = $this->faxStoragePathResolver->getFilePath($faxOut);
        $tifFile = sprintf("/tmp/fax-out-%d.tif", $faxId);
        $this->agi->notice("Converting fax file %s to TIFF.", $faxOut);

        $process = new Process([
            "/usr/bin/gs",
            "-q",
            "-g1728x1145",
            "-r209x98",
            "-dNOPAUSE",
            "-dBATCH",
            "-sDEVICE=tiffg4",
            "-sPAPERSIZE=a4",
            "-sOutputFile=". $tifFile,
            $pdfFile
        ]);
        $process->mustRun();

        /** @var FaxesInOutDTO $faxOutDto */
        $faxOutDto = $faxOut->toDTO();

        // Execute conversion command
        if ($process->getExitCode() != 0) {
            $this->agi->error("Unable to convert fax file %s to TIFF.", $faxOut);
            $faxOutDto->setStatus('error');
            $this->entityPersister->persistDto($faxOutDto, $faxOut);
            return;
        } else {
            $faxOutDto->setStatus('inprogress');
            $this->entityPersister->persistDto($faxOutDto, $faxOut);
        }

        // Set the virtual fax as caller
        $this->agi->setChannelCaller($faxOut->getFax());

        // ProcessDialStatus
        $this->externalFaxCallAction
            ->setFaxFile($faxOut)
            ->setDestination($faxOut->getDstE164())
            ->process();
    }

}