<?php

namespace Agi\Action;

use Agi\Wrapper;
use Ivoz\Provider\Domain\Model\Locution\LocutionInterface;

class LocutionAction
{
    /**
     * @var Wrapper
     */
    protected $agi;

    /**
     * @var LocutionInterface|null
     */
    protected $locution;

    /**
     * LocutionAction constructor.
     *
     * @param Wrapper $agi
     */
    public function __construct(
        Wrapper $agi
    ) {
        $this->agi = $agi;
    }

    /**
     * @param LocutionInterface $locution
     * @return $this
     */
    public function setLocution(LocutionInterface $locution = null): self
    {
        $this->locution = $locution;
        return $this;
    }

    public function process(): void
    {
        $locution = $this->locution;
        if (is_null($locution)) {
            $this->agi->error("Locution is not properly defined. Check configuration.");
            $this->agi->hangup();
            return;
        }

        // Some feedback for asterisk cli
        $this->agi->notice("Processing Locution %s [%s]", $locution->getName(), $locution);

        // Play locution and hangup
        $this->agi->playbackLocution($locution);
        $this->agi->hangup();
    }
}
