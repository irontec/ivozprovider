<?php

namespace Agi\Action;

class VoiceMailAction extends RouterAction
{
    protected $_voicemail;

    protected $_playBanner = false;

    public function setPlayBanner($playBanner)
    {
        $this->_playBanner = $playBanner;
        return $this;
    }

    public function setVoiceMail($voicemail)
    {
        $this->_voicemail = $voicemail;
        return $this;
    }

    public function process()
    {
        // Check extension is defined
        $voicemail = $this->_voicemail;
        if (empty($voicemail)) {
            $this->agi->error("Voicemail is not properly defined. Check configuration.");
            return;
        }

        // Some feedback for asterisk cli
        $this->agi->notice("Processing Voicemail of %s [user%d]",
                        $voicemail->getFullName(), $voicemail->getId());

        // Transfor number to User Preferred
        if ($this->agi->getCallType() == "external") {
            $preferred = $voicemail->E164ToPreferred($this->agi->getOrigCallerIdNum());
            $this->agi->setCallerIdNum($preferred);
        }

        if ($voicemail->getVoicemailEnabled()) {
            // Run the voicemail
            $vmopts = ($this->_playBanner) ? "u" : "s";
            $this->agi->voicemail($voicemail->getVoiceMail(), $vmopts);
        } else {
            $this->agi->error("User %s has voicemail disabled.", $voicemail->getFullName());
            $this->agi->busy();
        }
    }

}
