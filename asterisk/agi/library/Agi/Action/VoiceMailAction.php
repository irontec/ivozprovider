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

        // Get VoiceMail company
        $company = $voicemail->getCompany();

        // Run the voicemail
        $this->agi->voicemail($voicemail->getId(), $company->getId());
    }

}
