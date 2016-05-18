<?php

namespace Agi\Action;

class VoiceMailAction extends RouterAction
{
    protected $_voicemail;

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

        // Transfor number to User Preferred
        if ($this->agi->getCallType() == "external") {
            $preferred = $voicemail->E164ToPreferred($this->agi->getOrigCallerIdNum());
            $this->agi->setCallerIdNum($preferred);
        }

        if ($voicemail->getVoicemailEnabled()) {
            // Run the voicemail
            $this->agi->voicemail($voicemail->getVoiceMail());
        } else {
            $this->agi->verbose("User %s has voicemail disabled.", $voicemail->getFullName());
            $this->agi->busy();
        }
    }

}
