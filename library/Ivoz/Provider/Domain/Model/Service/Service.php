<?php

namespace Ivoz\Provider\Domain\Model\Service;

use Assert\Assertion;
use DomainException;

/**
 * Service
 */
class Service extends ServiceAbstract implements ServiceInterface
{
    use ServiceTrait;

    public const DIRECT_PICKUP     = "DirectPickUp";

    public const GROUP_PICKUP      = "GroupPickUp";

    public const VOICEMAIL         = "Voicemail";

    public const RECORD_LOCUTION   = "RecordLocution";

    public const CLOSE_LOCK        = "CloseLock";

    public const OPEN_LOCK         = "OpenLock";

    public const TOGGLE_LOCK       = "ToggleLock";

    public const CALL_FORWARD_INCONDITIONAL = "CallForwardInconditional";

    public const CALL_FORWARD_BUSY = "CallForwardBusy";

    public const CALL_FORWARD_NOANSWER = "CallForwardNoAnswer";

    public const CALL_FORWARD_UNREACHEABLE = "CallForwardUnreachable";

    // Available services for vPBX clients
    public const VPBX_AVAILABLE_SERVICES = [
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
     * @return array<string, mixed>
     */
    public function getChangeSet(): array
    {
        return parent::getChangeSet();
    }

    /**
     * @throws \Exception
     */
    protected function sanitizeValues(): void
    {

        if (!$this->isNew()) {
            $changedIden = $this->hasChanged('iden');

            if ($changedIden) {
                throw new \DomainException('Forbidden service iden update ');
            }

            $changedName =
                $this->hasChanged('nameEn')
                || $this->hasChanged('nameEs')
                || $this->hasChanged('nameCa')
                || $this->hasChanged('nameIt');

            if ($changedName) {
                throw new \DomainException('Forbidden service name update ');
            }

            $changedDescription =
                $this->hasChanged('descriptionEn')
                || $this->hasChanged('descriptionEs')
                || $this->hasChanged('descriptionCa')
                || $this->hasChanged('descriptionIt');

            if ($changedDescription) {
                throw new \DomainException('Forbidden service description update ');
            }
        }
    }



    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId(): ?int
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
