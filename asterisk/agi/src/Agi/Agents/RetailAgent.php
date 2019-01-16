<?php

namespace Agi\Agents;

use Agi\Wrapper;
use Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceInterface;
use Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountInterface;

class RetailAgent implements AgentInterface
{
    use AgentTrait;

    /** @var Wrapper */
    private $agi;

    /** @var RetailAccountInterface */
    private $retailAccount;

    /**
     * ResidentialAgent constructor.
     *
     * @param Wrapper $agi
     * @param RetailAccountInterface $retailAccount
     */
    public function __construct(
        Wrapper $agi,
        RetailAccountInterface $retailAccount
    ) {
        $this->retailAccount = $retailAccount;
        $this->agi = $agi;
    }

    public function getType()
    {
        return "Retail";
    }

    public function getId()
    {
        return $this->retailAccount->getId();
    }

    public function getCompany()
    {
        return $this->retailAccount->getCompany();
    }

    public function getLanguageCode()
    {
        return $this->retailAccount->getCompany()->getLanguageCode();
    }

    public function getOutgoingDdi($destination)
    {
        // Allow identification from any Residential Device DDI
        $callerIdNum = $this->agi->getCallerIdNum();
        $ddi = $this->retailAccount->getDDI($callerIdNum);

        if (empty($ddi)) {
            // Check presented number against company DDIs
            $companyDDIs = $this->retailAccount->getCompany()->getDDIs();
            foreach ($companyDDIs as $companyDDI) {
                if ($callerIdNum === $companyDDI->getDdie164()) {
                    $this->agi->notice(
                        "Retail %s presented origin matches company DDI %s",
                        $this->retailAccount,
                        $companyDDI
                    );
                    $ddi = $companyDDI;
                    break;
                }
            }
        }

        if (!isset($ddi)) {
            // Allow diversion from any company DDI
            $callerIdNum = $this->agi->getRedirecting('from-num');

            foreach ($companyDDIs as $companyDDI) {
                if ($callerIdNum === $companyDDI->getDdie164()) {
                    $this->agi->notice("Retail %s presented diversion matches company DDI %s", $this->retailAccount, $companyDDI);
                    $ddi = $companyDDI;
                    break;
                }
            }
        }

        // Use fallback outgoing DDI
        if (empty($ddi)) {
            $ddi = $this->retailAccount->getOutgoingDDI();
            if ($ddi) {
                $this->agi->notice(
                    "Using fallback DDI %s for friend %s because %s does not match any DDI.",
                    $ddi,
                    $this->retailAccount,
                    $callerIdNum
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
}
