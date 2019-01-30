<?php

namespace Agi\Action;

use Agi\Wrapper;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\Model\Helper\CriteriaHelper;
use Ivoz\Provider\Domain\Model\CallForwardSetting\CallForwardSettingInterface;
use Ivoz\Provider\Domain\Model\User\UserInterface;

class UserCallAction
{
    /**
     * @var Wrapper
     */
    protected $agi;

    /**
     * @var UserInterface
     */
    protected $user;

    /**
     * @var RouterAction
     */
    protected $routerAction;

    /**
     * @var UserStatusAction
     */
    protected $userStatusAction;

    /**
     * UserCallAction constructor.
     *
     * @param Wrapper $agi
     * @param RouterAction $routerAction
     * @param UserStatusAction $userStatusAction
     */
    public function __construct(
        Wrapper $agi,
        RouterAction $routerAction,
        UserStatusAction $userStatusAction
    ) {
        $this->agi = $agi;
        $this->routerAction = $routerAction;
        $this->userStatusAction = $userStatusAction;
    }

    public function setUser($user)
    {
        $this->user = $user;
        return $this;
    }

    public function process()
    {
        if (empty($this->user)) {
            $this->agi->error("User is not properly defined. Check configuration.");
            return;
        }

        // Local variables to improve readability
        $user = $this->user;

        // Check if user has extension configured
        $extension = $this->user->getExtension();
        if (empty($extension)) {
            $this->agi->error("User %s has no extension.", $user);
            return;
        }

        // Check if user has terminal configured
        $terminal = $this->user->getTerminal();
        if (empty($terminal)) {
            $this->agi->error("User %s has no terminal.", $user);

            $this->userStatusAction
                ->setUser($this->user)
                ->setDialStatus(UserStatusAction::ChanUnavailable)
                ->process();

            return;
        }

        // Some verbose dolan pls
        $this->agi->notice("Preparing call to user <green>%s</green> (<cyan>%s</cyan>)", $user, $terminal);

        // Check if user has call forwarding enabled
        $forwarded = $this->userStatusAction
                        ->setUser($this->user)
                        ->setDialStatus(UserStatusAction::Forwarded)
                        ->process();

        if ($forwarded) {
            return;
        }

        // User requested peace
        if ($user->getDoNotDisturb()) {
            $this->agi->verbose("User %s has DND enabled.", $user);

            $this->userStatusAction
                ->setUser($this->user)
                ->setDialStatus(UserStatusAction::Busy)
                ->process();

            return;
        }

        // Check if this user is a boss
        if ($user->getIsBoss() && !$this->canCallBoss($user, $this->agi->getCallerIdNum())) {
            $this->agi->verbose("Boss can't be disturbed by %s. Calling assistant.", $this->agi->getCallerIdNum());

            // Call the assistant
            $this->routerAction
                ->setRouteType(RouterAction::User)
                ->setRouteUser($user->getBossAssistant())
                ->route();

            return;
        }

        // Check if user is available before placing the call
        $endpointName = $terminal->getSorcery();

        // Configure Dial options
        $timeout = $this->getDialTimeout();
        $options = "i";

        if ($this->getUserStatusRequired()) {
            $options .= "g";
        }

        // For record asterisk builtin feature code (FIXME Dont use both X's)
        if ($user->getCompany()->getOnDemandRecord() == 2) {
            $options .= "xX";
        }

        // Call the PSJIP endpoint
        $this->agi->setVariable("DIAL_EXT", $extension->getNumber());
        $this->agi->setVariable("DIAL_DST", "PJSIP/$endpointName");
        $this->agi->setVariable("__DIAL_ENDPOINT", $endpointName);
        $this->agi->setVariable("DIAL_TIMEOUT", $timeout);
        $this->agi->setVariable("DIAL_OPTS", $options);

        // Redirect to the calling dialplan context
        $this->agi->redirect('call-user', $extension->getNumber());
    }

    /**
     * @param UserInterface $boss
     * @param string $source
     * @return bool
     */
    private function canCallBoss(UserInterface $boss, string $source)
    {
        // Assistant can allways call its boss
        $assistant = $boss->getBossAssistant();
        if (!empty($assistant)) {
            $assistantext = $assistant->getExtension();
            if (!empty($assistantext) && $assistantext->getNumber() == $source) {
                return true;
            }
        }

        // Check if boss has whitelisted hosts
        $bossWhiteList = $boss->getBossAssistantWhiteList();
        if (empty($bossWhiteList)) {
            return false;
        }

        // Check if source matches one of the whitelisted patterns
        if ($bossWhiteList->numberMatches($source)) {
            $this->agi->verbose("%s is in the exception lists of Boss %s.", $source, $boss);
            return true;
        }

        return false;
    }

    /**
     * If user has NoAnswer Call forward setting, return the dial timeout
     *
     * @return string
     */
    private function getDialTimeout()
    {
        $timeout = null;

        // Get active NoAnswer call forwards
        $criteria = [
            array('callForwardType', 'eq', 'noAnswer'),
            array('enabled', 'eq', '1'),
        ];

        /**
         * @var CallForwardSettingInterface[] $cfwSettings
         */
        $cfwSettings = $this->user->getCallForwardSettings(CriteriaHelper::fromArray($criteria));

        foreach ($cfwSettings as $cfwSetting) {
            $cfwType = $cfwSetting->getCallTypeFilter();
            if ($cfwType == "both" || $cfwType == $this->agi->getCallType()) {
                $this->agi->verbose("Call Forward No answer enabled [%s]. Setting call timeout.", $cfwSetting);
                $timeout = $cfwSetting->getNoAnswerTimeout();
            }
        }

        return ($timeout)?:"";
    }

    /**
     * Determine if we must check call status after dialing the user
     *
     * @return boolean
     */
    private function getUserStatusRequired()
    {
        // internal or external call
        $callType = $this->agi->getCallType();

        // Build the criteria to look for call forward settings
        $criteria = [
            'or' => array(
                array('callForwardType', 'eq', 'noAnswer'),
                array('callForwardType', 'eq', 'busy'),
                array('callForwardType', 'eq', 'userNotRegistered'),
            ),
            'or' => array(
                array('callTypeFilter', 'eq', 'both'),
                array('callTypeFilter', 'eq', $callType),
            ),
            array('enabled', 'eq', '1')
        ];

        /** @var CallForwardSettingInterface[] $cfwSettings */
        $cfwSettings = $this->user->getCallForwardSettings(CriteriaHelper::fromArray($criteria));

        // Return true if any of the requested Call forwards exist
        $settingNotEmpty = !empty($cfwSettings);
        return $settingNotEmpty;
    }
}
