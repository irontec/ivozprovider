<?php
namespace Agi\Action;

use Agi\Agents\ResidentialAgent;
use Agi\ChannelInfo;
use Agi\Wrapper;
use Ivoz\Provider\Domain\Model\CallForwardSetting\CallForwardSettingInterface;


class CallForwardResidentialAction
{
    /**
     * @var Wrapper
     */
    protected $agi;

    /**
     * @var ChannelInfo
     */
    protected $channelInfo;

    /**
     * Max allowed Call forwards from a channel
     *
     * @var int
     */
    protected $_maxRedirections = 5;

    /**
     * @var CallForwardSettingInterface
     */
    protected $cfw;

    /**
     * @var ExternalNumberAction
     */
    protected $externalNumberAction;

    /**
     * @var VoiceMailAction
     */
    protected $voiceMailAction;

    /**
     * CallForwardAction constructor.
     *
     * @param Wrapper $agi
     * @param ChannelInfo $channelInfo
     * @param ExternalNumberAction $externalNumberAction
     * @param VoiceMailAction $voiceMailAction
     */
    public function __construct(
        Wrapper $agi,
        ChannelInfo $channelInfo,
        ExternalNumberAction $externalNumberAction,
        VoiceMailAction $voiceMailAction
    )
    {
        $this->agi = $agi;
        $this->channelInfo = $channelInfo;
        $this->externalNumberAction = $externalNumberAction;
        $this->voiceMailAction = $voiceMailAction;
    }

    /**
     * @param CallForwardSettingInterface $cfw
     * @return $this
     */
    public function setCallForward(CallForwardSettingInterface $cfw)
    {
        $this->cfw = $cfw;
        return $this;
    }

    public function process()
    {
        if (is_null($this->cfw)) {
            $this->agi->error("CallForward is not properly defined. Check configuration.");
            return;
        }

        // Some CLI information
        $this->agi->notice("Processing %s call forward", $this->cfw->getCallForwardType());

        /**
         * Set Diversion reason based on current Call Forward settings
         *
         * https://wiki.asterisk.org/wiki/display/AST/Function_REDIRECTING
         */
        switch ($this->cfw->getCallForwardType()) {
            case 'inconditional':
                $this->agi->setRedirecting('reason,i', 'cfu');
                break;
            case 'noAnswer':
                $this->agi->setRedirecting('reason,i', 'cfnr');
                break;
            case 'busy':
                $this->agi->setRedirecting('reason,i', 'cfb');
                break;
            case 'userNotRegistered':
                $this->agi->setRedirecting('reason,i', 'unavailable');
                break;
        }

        // Avoid Redirection loops
        $count = $this->agi->getRedirecting('count');
        if ($count < $this->_maxRedirections) {
            $this->agi->setRedirecting('count,i', ++$count);
        } else {
            $this->agi->error("Max %d redirection reached. Leaving.", $count);
            $this->agi->hangup(44);
            return;
        }

        // Use Redirecting user as caller on following routes
        $residential = $this->cfw->getResidentialDevice();
        $caller = new ResidentialAgent($this->agi, $residential);
        $this->channelInfo->setChannelCaller($caller);

        // Set as diversion number the user extension
        $this->agi->setRedirecting('from-num', $residential->getOutgoingDdiNumber());

        if ($this->cfw->getTargetType() == RouterAction::Voicemail) {
            // Set as diversion number the user extension
            $this->voiceMailAction
                ->setPlayBanner(true)
                ->setVoiceMail($caller)
                ->processResidential();

        } else if ($this->cfw->getTargetType() == RouterAction::External) {

            // Route to destination
            $this->externalNumberAction
                ->setDestination($this->cfw->getNumberValueE164())
                ->process();
        }
    }
}
