<?php

namespace Agi\Action;

use Agi\Wrapper;
use Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountInterface;


class RetailCallAction
{
    /**
     * @var Wrapper
     */
    protected $agi;

    /**
     * @var RetailAccountInterface
     */
    protected $retailAccount;

    /**
     * RetailCallAction constructor.
     * @param Wrapper $agi
     */
    public function __construct(
        Wrapper $agi
    )
    {
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

        // Transform destination to retail preferred format
        $number =  $this->agi->getExtension();

        // Some verbose dolan pls
        $this->agi->notice("Preparing call to %s through account %s", $number, $retailAccount);

        // Get retail account endpoint
        $endpointName = $retailAccount->getSorcery();

        // Configure Dial options
        $options = "";

        // Call the PSJIP endpoint
        $this->agi->setVariable("DIAL_EXT", $number);
        $this->agi->setVariable("DIAL_DST", "PJSIP/$endpointName");
        $this->agi->setVariable("__DIAL_ENDPOINT", $endpointName);
        $this->agi->setVariable("DIAL_TIMEOUT", "");
        $this->agi->setVariable("DIAL_OPTS", $options);

        // Redirect to the calling dialplan context
        $this->agi->redirect('call-friend', $number);
    }

}
