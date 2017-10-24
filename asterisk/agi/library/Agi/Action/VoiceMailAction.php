<?php

namespace Agi\Action;

use Assert\Assertion;

class VoiceMailAction extends RouterAction
{
    /**
     * @var \Ivoz\Provider\Domain\Model\User\UserInterface
     */
    protected $_voicemail;

    /**
     * @var bool
     */
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
        Assertion::notNull(
            $voicemail,
            "Voicemail is not properly defined. Check configuration."
        );

        // Some feedback for asterisk cli
        $this->agi->notice("Processing Voicemail of %s [user%d]",
                        $voicemail->getFullName(), $voicemail->getId());

        if ($voicemail->getVoicemailEnabled()) {
            // Run the voicemail
            $vmopts = "";
            if ($this->_playBanner) {
                if ($voicemail->getVoiceMailLocution()) {
                    $this->agi->verbose("Playing custom user Voicemail Locution.");
                    $this->agi->playback($voicemail->getVoiceMailLocution());
                    $vmopts .= "s";     // Skip welcome message
                } else {
                    $vmopts .= "u";     // Play unavailable message
                }
            } else {
                $vmopts .= "s";         // Skip welcome message
            }
            $this->agi->voicemail($voicemail->getVoiceMail(), $vmopts);
        } else {
            $this->agi->error("User %s has voicemail disabled.", $voicemail->getFullName());
            $this->agi->busy();
        }
    }

}
