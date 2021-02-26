<?php

namespace Ivoz\Provider\Domain\Model\Service;

use Assert\Assertion;

/**
 * Service
 */
class Service extends ServiceAbstract implements ServiceInterface
{
    use ServiceTrait;

    const DIRECT_PICKUP     = "DirectPickUp";

    const GROUP_PICKUP      = "GroupPickUp";

    const VOICEMAIL         = "Voicemail";

    const RECORD_LOCUTION   = "RecordLocution";

    const CLOSE_LOCK        = "CloseLock";

    const OPEN_LOCK         = "OpenLock";

    const TOGGLE_LOCK       = "ToggleLock";

    const CALL_FORWARD_INCONDITIONAL = "CallForwardInconditional";

    const CALL_FORWARD_BUSY = "CallForwardBusy";

    const CALL_FORWARD_NOANSWER = "CallForwardNoAnswer";

    const CALL_FORWARD_UNREACHEABLE = "CallForwardUnreachable";

    // Available services for vPBX clients
    const VPBX_AVAILABLE_SERVICES = [
        Service::DIRECT_PICKUP,
        Service::GROUP_PICKUP,
        Service::VOICEMAIL,
        Service::RECORD_LOCUTION,
        Service::CLOSE_LOCK,
        Service::OPEN_LOCK,
        Service::TOGGLE_LOCK,
    ];

    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet()
    {
        return parent::getChangeSet();
    }

    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * {@inheritDoc}
     */
    public function setDefaultCode(string $defaultCode): static
    {
        Assertion::regex($defaultCode, '/^[#0-9*]+$/');
        return parent::setDefaultCode($defaultCode);
    }
}
