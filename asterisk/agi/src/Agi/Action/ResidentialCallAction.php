<?php

namespace Agi\Action;

use Agi\Wrapper;
use Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceInterface;


class ResidentialCallAction
{
    /**
     * @var Wrapper
     */
    protected $agi;

    /**
     * @var ResidentialDeviceInterface
     */
    protected $residentialDevice;

    /**
     * ResidentialCallAction constructor.
     * @param Wrapper $agi
     */
    public function __construct(
        Wrapper $agi
    )
    {
        $this->agi = $agi;
    }

    /**
     * @param ResidentialDeviceInterface|null $residentialDevice
     * @return $this
     */
    public function setResidentialDevice(ResidentialDeviceInterface $residentialDevice = null)
    {
        $this->residentialDevice = $residentialDevice;
        return $this;
    }

    public function process()
    {
        // Local variables to improve readability
        $residentialDevice = $this->residentialDevice;

        if (is_null($residentialDevice)) {
            $this->agi->error("Residential Device is not properly defined. Check configuration.");
            return;
        }

        // Get dialed number
        $number =  $this->agi->getExtension();

        // Some verbose dolan pls
        $this->agi->notice("Preparing call to %s through account %s", $number, $residentialDevice);

        // Get device endpoint
        $endpointName = $residentialDevice->getSorcery();

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
