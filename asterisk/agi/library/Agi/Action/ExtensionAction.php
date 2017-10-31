<?php

namespace Agi\Action;

use Assert\Assertion;

class ExtensionAction extends RouterAction
{
    /**
     * @var \Ivoz\Provider\Domain\Model\Extension\ExtensionInterface
     */
    protected $_extension;

    public function setExtension($extension)
    {
        $this->_extension = $extension;
        return $this;
    }

    public function getExtension()
    {
        return $this->_extension;
    }

    public function process()
    {
        // Check extension is defined
        $extension = $this->_extension;
        Assertion::notNull(
            $extension,
            "Extension is not properly defined. Check configuration."
        );

        // Some feedback for asterisk cli
        $this->agi->notice("Processing Extension with number %s",
                        $extension->getNumber(), $extension->getId());

        // Route to the extension destination
        $this->_routeType       = $extension->getRouteType();
        $this->_routeUser       = $extension->getUser();
        $this->_routeIVRCommon  = $extension->getIVRCommon();
        $this->_routeIVRCustom  = $extension->getIVRCustom();
        $this->_routeHuntGroup  = $extension->getHuntGroup();
        $this->_routeConference = $extension->getConferenceRoom();
        $this->_routeExternal   = $extension->getNumberValueE164();
        $this->_routeFriend     = $extension->getFriendValue();
        $this->_routeQueue      = $extension->getQueue();
        $this->_routeConditionalRoute = $extension->getConditionalRoute();
        $this->route();
    }

}
