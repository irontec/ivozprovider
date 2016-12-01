<?php

namespace Agi\Action;

class ExtensionAction extends RouterAction
{
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
        if (empty($extension)) {
            $this->agi->error("Extension is not properly defined. Check configuration.");
            return;
        }

        // Some feedback for asterisk cli
        $this->agi->notice("Processing Extension with number \e[0;37m%s [extension%d]\e[0;93m",
                        $extension->getNumber(), $extension->getId());

        // Route to the extension destination
        $this->_routeType       = $extension->getRouteType();
        $this->_routeUser       = $extension->getUser();
        $this->_routeIVRCommon  = $extension->getIVRCommon();
        $this->_routeIVRCustom  = $extension->getIVRCustom();
        $this->_routeHuntGroup  = $extension->getHuntGroup();
        $this->_routeConference = $extension->getConferenceRoom();
        $this->_routeExternal   = $extension->getNumberValue();
        $this->_routeFriend     = $extension->getFriendValue();
        $this->route();
    }

}
