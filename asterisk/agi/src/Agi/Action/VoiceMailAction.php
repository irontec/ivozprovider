<?php

namespace Agi\Action;

use Agi\Wrapper;
use Ivoz\Provider\Domain\Model\User\UserInterface;

class VoiceMailAction
{
    /**
     * @var Wrapper
     */
    protected $agi;

    /**
     * @var UserInterface
     */
    protected $voicemail;

    /**
     * @var bool
     */
    protected $playBanner = false;

    /**
     * VoiceMailAction constructor.
     *
     * @param Wrapper $agi
     */
    public function __construct(
        Wrapper $agi
    )
    {
        $this->agi = $agi;
    }

    /**
     * @param bool $playBanner
     * @return $this
     */
    public function setPlayBanner(bool $playBanner)
    {
        $this->playBanner = $playBanner;
        return $this;
    }

    /**
     * @param UserInterface|null $voicemail
     * @return $this
     */
    public function setVoiceMail(UserInterface $voicemail = null)
    {
        $this->voicemail = $voicemail;
        return $this;
    }

    public function process()
    {
        // Check extension is defined
        $voicemail = $this->voicemail;

        if (is_null($voicemail)) {
            $this->agi->error("Voicemail is not properly defined. Check configuration.");
        }

        // Some feedback for asterisk cli
        $this->agi->notice("Processing Voicemail of %s", $voicemail);

        if ($voicemail->getVoicemailEnabled()) {
            // Run the voicemail
            $vmopts = "";
            if ($this->playBanner) {
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
