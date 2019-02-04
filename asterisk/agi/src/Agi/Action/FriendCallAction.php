<?php

namespace Agi\Action;

use Agi\Wrapper;
use Ivoz\Provider\Domain\Model\Friend\FriendInterface;

class FriendCallAction
{
    /**
     * @var Wrapper
     */
    protected $agi;

    /**
     * @var FriendInterface
     */
    protected $friend;

    /**
     * @var string
     */
    protected $destination;

    /**
     * FriendCallAction constructor.
     *
     * @param Wrapper $agi
     */
    public function __construct(Wrapper $agi)
    {
        $this->agi = $agi;
    }

    /**
     * @param FriendInterface|null $friend
     * @return $this
     */
    public function setFriend(FriendInterface $friend = null)
    {
        $this->friend = $friend;
        return $this;
    }

    /**
     * @param string|null $number
     * @return $this
     */
    public function setDestination(string $number = null)
    {
        $this->destination = $number;
        return $this;
    }

    public function process()
    {
        // Local variables to improve readability
        $friend = $this->friend;
        $number = $this->destination;

        if (is_null($friend)) {
            $this->agi->error("Friend is not properly defined. Check configuration.");
            return;
        }

        // Some verbose dolan pls
        $this->agi->notice("Preparing call to %s through friend <cyan>%s</cyan>", $number, $friend);

        // Check if user is available before placing the call
        $endpointName = $friend->getSorcery();

        // Configure Dial options
        $options = "";

        // Call the PSJIP endpoint
        $this->agi->setVariable("DIAL_EXT", $number);
        $this->agi->setVariable("DIAL_DST", "PJSIP/$endpointName");
        $this->agi->setVariable("__DIAL_ENDPOINT", $endpointName);
        $this->agi->setVariable("DIAL_TIMEOUT", "");
        $this->agi->setVariable("DIAL_OPTS", $options);

        // Redirect to the calling dialplan context
        $this->agi->redirect('call-friend', $number);
    }
}
