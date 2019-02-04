<?php

namespace Agi\Action;

use Agi\Wrapper;
use Ivoz\Provider\Domain\Model\Extension\ExtensionInterface;

class ExtensionAction
{
    /**
     * @var Wrapper
     */
    protected $agi;

    /**
     * @var RouterAction
     */
    protected $routerAction;

    /**
     * @var ExtensionInterface
     */
    protected $extension;

    /**
     * ExtensionAction constructor.
     * @param Wrapper $agi
     * @param RouterAction $routerAction
     */
    public function __construct(
        Wrapper $agi,
        RouterAction $routerAction
    ) {
        $this->agi = $agi;
        $this->routerAction = $routerAction;
    }

    public function setExtension(ExtensionInterface $extension)
    {
        $this->extension = $extension;
        return $this;
    }

    public function process()
    {
        // Check extension is defined
        $extension = $this->extension;

        if (is_null($extension)) {
            $this->agi->error("Extension is not properly defined. Check configuration.");
            return;
        }

        // Some feedback for asterisk cli
        $this->agi->notice("Processing Extension <white>%s</white>", $extension);

        // Route to the extension destination
        $this->routerAction
            ->setRouteType($extension->getRouteType())
            ->setRouteUser($extension->getUser())
            ->setRouteIvr($extension->getIvr())
            ->setRouteHuntGroup($extension->getHuntGroup())
            ->setRouteConferenceRoom($extension->getConferenceRoom())
            ->setRouteExternal($extension->getNumberValueE164())
            ->setRouteFriendDestination($extension->getFriendValue())
            ->setRouteQueue($extension->getQueue())
            ->setRouteConditional($extension->getConditionalRoute())
            ->route();
    }
}
