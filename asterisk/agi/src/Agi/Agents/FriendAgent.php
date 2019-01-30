<?php

namespace Agi\Agents;

use Agi\Wrapper;
use Ivoz\Provider\Domain\Model\Friend\FriendInterface;

class FriendAgent implements AgentInterface
{
    use AgentTrait;

    /** @var Wrapper */
    private $agi;

    /** @var FriendInterface */
    private $friend;

    /**
     * FriendAgent constructor.
     *
     * @param FriendInterface $friend
     * @param Wrapper $agi
     */
    public function __construct(
        Wrapper $agi,
        FriendInterface $friend
    ) {
        $this->friend = $friend;
        $this->agi = $agi;
    }

    public function getType()
    {
        return "Friend";
    }

    public function getId()
    {
        return $this->friend->getId();
    }

    public function getCompany()
    {
        return $this->friend->getCompany();
    }

    public function getLanguageCode()
    {
        return $this->friend->getLanguageCode();
    }

    public function getOutgoingDdi($destination)
    {
        // Allow identification from any company DDI
        $callerIdNum = $this->agi->getCallerIdNum();

        // Check presented number against company DDIs
        $companyDDIs = $this->friend->getCompany()->getDDIs();
        foreach ($companyDDIs as $companyDDI) {
            if ($callerIdNum === $companyDDI->getDdie164()) {
                $this->agi->notice("Friend %s presented origin matches company DDI %s", $this->friend, $companyDDI);
                $ddi = $companyDDI;
                break;
            }
        }

        if (!isset($ddi)) {
            // Allow diversion from any company DDI
            $callerIdNum = $this->agi->getRedirecting('from-num');

            foreach ($companyDDIs as $companyDDI) {
                if ($callerIdNum === $companyDDI->getDdie164()) {
                    $this->agi->notice("Friend %s presented diversion matches company DDI %s", $this->friend, $companyDDI);
                    $ddi = $companyDDI;
                    break;
                }
            }
        }

        // Use fallback outgoing DDI
        if (!isset($ddi)) {
            $ddi = $this->friend->getOutgoingDDI();
            if ($ddi) {
                $this->agi->notice(
                    "Using fallback DDI %s for friend %s because %s does not match any DDI.",
                    $ddi,
                    $this->friend,
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
        return $this->friend->isAllowedToCall($destination);
    }
}
