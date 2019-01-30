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

class FaxSendStatus extends RouteHandlerAbstract
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

        // Check no errors happened during ReceiveFax
        $error = $this->agi->getVariable("FAXOPT(error)");
        $statusstr = $this->agi->getVariable("FAXOPT(statusstr)");

        if (! empty($error) && $statusstr != "OK") {
            // Show error message in asterisk CLI
            $this->agi->error("Error sending fax: $statusstr ($error)");
            /** @var FaxesInOutDTO $faxOutDto */
            $faxOutDto = $this->entityTools->entityToDto($faxOut);
            $faxOutDto->setStatus('error');
            $this->entityTools->persistDto(
                $faxOutDto,
                $faxOut
            );
            return;
        }

        // Store fax pages
        $pages = $this->agi->getVariable("FAXOPT(pages)");

        // Mark as success and save
        /** @var FaxesInOutDTO $faxOutDto */
        $faxOutDto = $this->entityTools->entityToDto($faxOut);
        $faxOutDto
            ->setStatus('completed')
            ->setPages($pages);

        $this->entityTools->persistDto(
            $faxOutDto,
            $faxOut
        );
    }
}
