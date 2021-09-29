<?php

namespace Agi\Action;

use Agi\Wrapper;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\Model\Helper\CriteriaHelper;
use Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountInterface;

class RetailCallAction
{
    /**
     * @var Wrapper
     */
    protected $agi;

    /**
     * @var RetailAccountInterface|null
     */
    protected $retailAccount;

    /**
     * RetailCallAction constructor.
     * @param Wrapper $agi
     */
    public function __construct(
        Wrapper $agi
    ) {
        $this->agi = $agi;
    }

    /**
     * @param RetailAccountInterface|null $retailAccount
     * @return $this
     */
    public function setRetailAccount(RetailAccountInterface $retailAccount = null)
    {
        $this->retailAccount = $retailAccount;
        return $this;
    }

    public function process()
    {
        // Local variables to improve readability
        $retailAccount = $this->retailAccount;

        if (is_null($retailAccount)) {
            $this->agi->error("Retail Account is not properly defined. Check configuration.");
            return;
        }

        // Get dialed number (DDI called to cause this call-forward)
        $number =  $this->agi->getExtension();

        // Get device endpoint
        $endpointName = $retailAccount->getSorcery();

        // Some verbose dolan pls
        $this->agi->notice("Preparing call to %s", $endpointName);

        // Configure Dial options
        $timeout = "10800";
        $options = "g";

        // Call the PSJIP endpoint
        $this->agi->setVariable("DIAL_DST", "PJSIP/$endpointName");
        $this->agi->setVariable("__DIAL_ENDPOINT", $endpointName);
        $this->agi->setVariable("DIAL_TIMEOUT", $timeout);
        $this->agi->setVariable("DIAL_OPTS", $options);

        // Redirect to the calling dialplan context
        $this->agi->redirect('call-retail', $number);
    }
}
