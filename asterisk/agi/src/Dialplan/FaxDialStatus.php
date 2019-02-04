<?php

namespace Dialplan;

use Agi\Wrapper;
use Doctrine\ORM\EntityManagerInterface;
use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\FaxesInOut\FaxesInOut;
use Ivoz\Provider\Domain\Model\FaxesInOut\FaxesInOutDTO;
use Ivoz\Provider\Domain\Model\FaxesInOut\FaxesInOutInterface;
use Ivoz\Provider\Domain\Model\FaxesInOut\FaxesInOutRepository;
use RouteHandlerAbstract;

class FaxDialStatus extends RouteHandlerAbstract
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
     * Dial constructor.
     * @param Wrapper $agi
     * @param EntityManagerInterface $em
     * @param EntityTools $entityTools
     */
    public function __construct(
        Wrapper $agi,
        EntityManagerInterface $em,
        EntityTools $entityTools
    ) {
        $this->agi = $agi;
        $this->em = $em;
        $this->entityTools = $entityTools;
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

        // Delete converted file after sending
        $tifFile = sprintf("/tmp/fax-out-%d.tif", $faxId);
        if (file_exists($tifFile)) {
            unlink($tifFile);
        }

        $dialStatus = $this->agi->getVariable("DIALSTATUS");
        if (!empty($dialStatus)) {
            $this->agi->notice("Fax file %s dial status %s", $faxOut, $dialStatus);
            // Store fax pages
            if ($dialStatus != "ANSWER") {
                // Mark as error and save
                /** @var FaxesInOutDTO $faxOutDto */
                $faxOutDto = $this->entityTools->entityToDto($faxOut);
                $faxOutDto->setStatus('error');
                $this->entityTools->persistDto($faxOutDto, $faxOut);
                return;
            }
        }
    }
}
