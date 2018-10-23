<?php

namespace Agi\Action;

use Agi\Wrapper;
use Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceInterface;
use Ivoz\Provider\Domain\Model\User\UserInterface;

class VoiceMailAction
{
    /**
     * @var Wrapper
     */
    protected $agi;

    /**
     * @var UserInterface|ResidentialDeviceInterface
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
     * @param UserInterface|ResidentialDeviceInterface|null $voicemail
     * @return $this
     */
    public function setVoiceMail($voicemail = null)
    {
        $this->voicemail = $voicemail;
        return $this;
    }

    public function process()
    {
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
                    $this->agi->playbackLocution($voicemail->getVoiceMailLocution());
                    $vmopts .= "s";     // Skip welcome message
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

    public function processResidential()
    {
        $voicemail = $this->voicemail;

        $this->agi->voicemail(
            $voicemail->getVoiceMail()
        );
    }

}
