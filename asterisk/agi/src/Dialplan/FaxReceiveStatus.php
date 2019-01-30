<?php

namespace Dialplan;

use Agi\Action\FaxReceiveStatusAction;
use Agi\Wrapper;
use Doctrine\ORM\EntityManagerInterface;
use Ivoz\Provider\Domain\Model\FaxesInOut\FaxesInOut;
use Ivoz\Provider\Domain\Model\FaxesInOut\FaxesInOutInterface;
use Ivoz\Provider\Domain\Model\FaxesInOut\FaxesInOutRepository;
use RouteHandlerAbstract;

class FaxReceiveStatus extends RouteHandlerAbstract
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
     * @var FaxReceiveStatusAction
     */
    protected $faxReceiveStatusAction;

    /**
     * Dial constructor.
     * @param Wrapper $agi
     * @param EntityManagerInterface $em
     * @param FaxReceiveStatusAction $faxReceiveStatusAction
     */
    public function __construct(
        Wrapper $agi,
        EntityManagerInterface $em,
        FaxReceiveStatusAction $faxReceiveStatusAction
    ) {
        $this->agi = $agi;
        $this->em = $em;
        $this->faxReceiveStatusAction = $faxReceiveStatusAction;
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

        $this->faxReceiveStatusAction
            ->setFaxInOut($faxOut)
            ->process();
    }
}
