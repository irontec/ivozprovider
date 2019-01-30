<?php

namespace Dialplan;

use Agi\Action\ExternalFaxCallAction;
use Agi\Agents\FaxAgent;
use Agi\ChannelInfo;
use Agi\Wrapper;
use Doctrine\ORM\EntityManagerInterface;
use Ivoz\Core\Application\Service\CommonStoragePathResolver;
use Ivoz\Core\Application\Service\EntityTools;
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
     * @var ChannelInfo
     */
    protected $channelInfo;

    /**
     * @var EntityManagerInterface
     */
    protected $em;

    /**
     * @var EntityPersisterInterface
     */
    protected $entityTools;

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
     * @param ChannelInfo $channelInfo
     * @param EntityManagerInterface $em
     * @param EntityTools $entityTools
     * @param CommonStoragePathResolver $faxStoragePathResolver
     * @param ExternalFaxCallAction $externalFaxCallAction
     */
    public function __construct(
        Wrapper $agi,
        ChannelInfo $channelInfo,
        EntityManagerInterface $em,
        EntityTools $entityTools,
        CommonStoragePathResolver $faxStoragePathResolver,
        ExternalFaxCallAction $externalFaxCallAction
    ) {
        $this->agi = $agi;
        $this->channelInfo = $channelInfo;
        $this->em = $em;
        $this->entityTools = $entityTools;
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
        $faxOutDto = $this->entityTools->entityToDto($faxOut);

        // Execute conversion command
        if ($process->getExitCode() != 0) {
            $this->agi->error("Unable to convert fax file %s to TIFF.", $faxOut);
            $faxOutDto->setStatus('error');
            $this->entityTools->persistDto($faxOutDto, $faxOut);
            return;
        } else {
            $faxOutDto->setStatus('inprogress');
            $this->entityTools->persistDto($faxOutDto, $faxOut);
        }

        // Set the virtual fax as caller
        $caller = new FaxAgent($this->agi, $faxOut->getFax());
        $this->channelInfo->setChannelCaller($caller);
        $this->channelInfo->setChannelOrigin($caller);

        // ProcessDialStatus
        $this->externalFaxCallAction
            ->setFaxFile($faxOut)
            ->setDestination($faxOut->getDstE164())
            ->process();
    }
}
