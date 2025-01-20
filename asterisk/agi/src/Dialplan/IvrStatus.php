<?php

namespace Dialplan;

use Agi\Action\IvrAction;
use Agi\Wrapper;
use Doctrine\ORM\EntityManagerInterface;
use Ivoz\Provider\Domain\Model\Ivr\Ivr;
use RouteHandlerAbstract;

class IvrStatus extends RouteHandlerAbstract
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
     * @var IvrAction
     */
    protected $ivrAction;

    /**
     * HuntGroups constructor.
     *
     * @param Wrapper $agi
     * @param EntityManagerInterface $em
     * @param IvrAction $ivrAction
     */
    public function __construct(
        Wrapper $agi,
        EntityManagerInterface $em,
        IvrAction $ivrAction
    ) {
        $this->agi = $agi;
        $this->em = $em;
        $this->ivrAction = $ivrAction;
    }

    /**
     * @brief Process Huntgroup after call status
     */
    public function process(): void
    {
        /** @var \Ivoz\Provider\Domain\Model\Ivr\IvrRepository $ivrRepository */
        $ivrRepository = $this->em->getRepository(Ivr::class);

        // Find the IVR to continue the process
        $ivrId = $this->agi->getVariable("IVR_ID");

        /** @var \Ivoz\Provider\Domain\Model\Ivr\IvrInterface $ivr */
        $ivr = $ivrRepository->find($ivrId);

        // Get user entered data
        $pressed = $this->agi->getVariable("IVR_PRESSED");

        // Handle last called user status
        $this->ivrAction
            ->setIVR($ivr)
            ->processUserEnteredData($pressed);
    }
}
