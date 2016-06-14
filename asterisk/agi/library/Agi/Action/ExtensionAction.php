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

    public function process()
    {
        // Check extension is defined
        $extension = $this->_extension;
        if (empty($extension)) {
            $this->agi->error("Extension is not properly defined. Check configuration.");
            return;
        }

        // Some feedback for asterisk cli
        $this->agi->notice("Processing Extension with number %s [extension%d]",
                        $extension->getNumber(), $extension->getId());

        // Route to the extension destination
        $this->_routeType       = $extension->getRouteType();
        $this->_routeUser       = $extension->getUser();
        $this->_routeIVRCommon  = $extension->getIVRCommon();
        $this->_routeIVRCustom  = $extension->getIVRCustom();
        $this->_routeHuntGroup  = $extension->getHuntGroup();
        $this->_routeConference = $extension->getConferenceRoom();
        $this->route();
    }


}
