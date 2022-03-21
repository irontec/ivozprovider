<?php

namespace Agi\Agents;

use Agi\Wrapper;
use Ivoz\Provider\Domain\Model\Locution\LocutionInterface;
use Ivoz\Provider\Domain\Model\PickUpGroup\PickUpGroupInterface;
use Ivoz\Provider\Domain\Model\Terminal\TerminalInterface;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Ivoz\Provider\Domain\Model\Voicemail\VoicemailInterface;

class UserAgent implements AgentInterface
{
    use AgentTrait;

    /** @var Wrapper */
    private $agi;

    /** @var UserInterface */
    private $user;

    /**
     * UserAgent constructor.
     *
     * @param Wrapper $agi
     * @param UserInterface $user
     */
    public function __construct(
        Wrapper $agi,
        UserInterface $user
    ) {
        $this->agi = $agi;
        $this->user = $user;
    }

    public function getType()
    {
        return "User";
    }

    public function getId()
    {
        return $this->user->getId();
    }

    public function getCompany()
    {
        return $this->user->getCompany();
    }

    public function getLanguageCode()
    {
        return $this->user->getLanguageCode();
    }

    public function getOutgoingDdi($destination)
    {
        // Get default user outgoing DDI
        $ddi = $this->user->getOutgoingDDI();

        // If user has OutgoingDDI rules, check if we have to override current DDI
        $outgoingDDIRule = $this->user->getOutgoingDDIRule();
        if ($outgoingDDIRule) {
            // Get calling Prefix if header is present
            $prefix = $this->agi->getSIPHeader('X-Info-DDI-Prefix');

            $this->agi->verbose("Checking %s for destination %s and prefix %s", $outgoingDDIRule, $destination, $prefix);

            // Check if outgoing DDI rule matches for given destination
            $ddiRule = $outgoingDDIRule->getOutgoingDDI($ddi, $destination, $prefix);
            if ($ddiRule) {
                $this->agi->notice("Rule %s changed presented DDI to %s", $outgoingDDIRule, $ddiRule);
                $ddi = $ddiRule;
            }
        }

        return $ddi;
    }

    public function getExtensionNumber()
    {
        return $this->user->getExtensionNumber();
    }

    /**
     * @param string $destination
     * @return boolean
     */
    public function isAllowedToCall($destination)
    {
        return $this->user->isAllowedToCall($destination);
    }

    /**
     * Return user pickup groups
     *
     * @return PickUpGroupInterface[]|null
     */
    public function getPickUpGroups()
    {
        return $this->user->getPickUpGroups();
    }

    /**
     * Return user voicemail identifier
     * @return VoicemailInterface
     */
    public function getVoicemail()
    {
        return $this->user->getVoicemail();
    }

    /**
     * @brief Determine if agent's endpoint has T.38 Passthrough enabled
     *
     * @return boolean
     */
    public function isT38PassthroughEnabled()
    {
        $terminal = $this->user->getTerminal();
        $psEndpoint = $terminal->getPsEndpoint();

        return $psEndpoint->getT38Udptl() == TerminalInterface::T38PASSTHROUGH_YES;
    }
}
