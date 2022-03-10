<?php

namespace Agi\Agents;

use Agi\Wrapper;
use Doctrine\Common\Collections\Criteria;
use Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceInterface;
use Ivoz\Provider\Domain\Model\Voicemail\VoicemailInterface;

class ResidentialAgent implements AgentInterface
{
    use AgentTrait;

    /** @var Wrapper */
    private $agi;

    /** @var ResidentialDeviceInterface */
    private $residential;

    /**
     * ResidentialAgent constructor.
     *
     * @param ResidentialDeviceInterface $residential
     * @param Wrapper $agi
     */
    public function __construct(
        Wrapper $agi,
        ResidentialDeviceInterface $residential
    ) {
        $this->residential = $residential;
        $this->agi = $agi;
    }

    public function getType()
    {
        return "Residential";
    }

    public function getId()
    {
        return $this->residential->getId();
    }

    public function getCompany()
    {
        return $this->residential->getCompany();
    }

    public function getLanguageCode()
    {
        return $this->residential->getLanguageCode();
    }

    public function getCallForwardSettings(Criteria $criteria = null)
    {
        return $this->residential
            ->getCallForwardSettings($criteria);
    }

    public function getOutgoingDdi($destination)
    {
        // Allow identification from any Residential Device DDI
        $callerIdNum = $this->agi->getCallerIdNum();
        $ddi = $this->residential->getDDI($callerIdNum);

        if (empty($ddi)) {
            // Check presented number against company DDIs
            $companyDDIs = $this->residential->getCompany()->getDDIs();
            foreach ($companyDDIs as $companyDDI) {
                if ($callerIdNum === $companyDDI->getDdie164()) {
                    $this->agi->notice(
                        "Residential %s presented origin matches company DDI %s",
                        $this->residential,
                        $companyDDI
                    );
                    $ddi = $companyDDI;
                    break;
                }
            }
        }

        if (empty($ddi) && isset($companyDDIs)) {
            // Allow diversion from any company DDI
            $callerIdNum = $this->agi->getRedirecting('from-num');

            foreach ($companyDDIs as $companyDDI) {
                if ($callerIdNum === $companyDDI->getDdie164()) {
                    $this->agi->notice("Residential %s presented diversion matches company DDI %s", $this->residential, $companyDDI);
                    $ddi = $companyDDI;
                    break;
                }
            }
        }

        // Use fallback outgoing DDI
        if (empty($ddi)) {
            $ddi = $this->residential->getOutgoingDDI();
            if ($ddi) {
                $this->agi->notice(
                    "Using fallback DDI %s for Residential %s because %s does not match any DDI.",
                    $ddi,
                    $this->residential,
                    $this->agi->getCallerIdNum()
                );
            }
        }

        return $ddi;
    }

    /**
     * @param string $destination
     * @return boolean
     */
    public function isAllowedToCall($destination)
    {
        return true;
    }

    /**
     * Return residential voicemail identifier
     * @return VoicemailInterface
     */
    public function getVoicemail()
    {
        return $this->residential->getVoicemail();
    }

    /**
     * @brief Determine if agent's endpoint has T.38 Passthrough enabled
     *
     * @return boolean
     */
    public function isT38PassthroughEnabled()
    {
        $psEndpoint = $this->residential->getPsEndpoint();

        return $psEndpoint->getT38Udptl() == ResidentialDeviceInterface::T38PASSTHROUGH_YES;
    }
}
