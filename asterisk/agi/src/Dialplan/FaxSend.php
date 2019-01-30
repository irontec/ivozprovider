<?php

namespace Dialplan;

use Agi\Wrapper;
use Doctrine\ORM\EntityManagerInterface;
use Ivoz\Provider\Domain\Model\FaxesInOut\FaxesInOut;
use Ivoz\Provider\Domain\Model\FaxesInOut\FaxesInOutInterface;
use Ivoz\Provider\Domain\Model\FaxesInOut\FaxesInOutRepository;
use RouteHandlerAbstract;

class FaxSend extends RouteHandlerAbstract
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
     * Dial constructor.
     * @param Wrapper $agi
     * @param EntityManagerInterface $em
     */
    public function __construct(
        Wrapper $agi,
        EntityManagerInterface $em
    ) {
        $this->agi = $agi;
        $this->em = $em;
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

        // Set recive fax options
        $this->agi->setVariable("FAX_OPT", "zf");
        $this->agi->setVariable("FAX_FILE", $tifFile);
    }
}
