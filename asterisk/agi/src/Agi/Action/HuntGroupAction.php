<?php

namespace Agi\Action;

use Agi\Wrapper;
use Doctrine\Common\Collections\Criteria;
use Ivoz\Provider\Domain\Model\HuntGroup\HuntGroupInterface;
use Ivoz\Provider\Domain\Model\HuntGroupsRelUser\HuntGroupsRelUserInterface;

class HuntGroupAction
{
    /**
     * Available Hunt Group strategies
     */
    const RingAll       = 'ringAll';
    const Linear        = 'linear';
    const RoundRobin    = 'roundRobin';
    const Random        = 'random';

    /**
     * @var Wrapper
     */
    protected $agi;

    /**
     * @var HuntGroupInterface
     */
    protected $huntgroup;

    /**
     * HuntGroupAction constructor.
     *
     * @param Wrapper $agi
     */
    public function __construct(
        Wrapper $agi
    ) {
        $this->agi = $agi;
    }

    /**
     * @param HuntGroupInterface|null $huntgroup
     * @return $this
     */
    public function setHuntGroup(HuntGroupInterface $huntgroup = null)
    {
        $this->huntgroup = $huntgroup;
        return $this;
    }

    public function process()
    {
        // Local variables to improve readability
        $huntGroup = $this->huntgroup;

        if (is_null($huntGroup)) {
            $this->agi->error("HuntGroup is not properly defined. Check configuration.");
            return;
        }

        $this->agi->notice("Processing %s HuntGroup %s", $huntGroup->getStrategy(), $huntGroup);

        /** @var HuntGroupsRelUserInterface[] $huntGroupEntries */
        $huntGroupEntries = $huntGroup->getHuntGroupsRelUsers(
            Criteria::create()->orderBy(['priority' => Criteria::ASC])
        );

        // Shuffle entries in random huntgroups
        if ($huntGroup->getStrategy() == HuntGroupAction::Random) {
            shuffle($huntGroupEntries);
        }

        // Check huntgroup users
        $huntGroupEndpoints = array();
        $huntGroupTimeouts = array();

        foreach ($huntGroupEntries as $entry) {
            // Get entry user
            $user = $entry->getUser();

            if (empty($user->getExtensionNumber())) {
                $this->agi->notice("Skipping user %s without extension.", $user);
                continue;
            }

            if (empty($user->getTerminal())) {
                $this->agi->notice("Skipping user %s without terminal.", $user);
                continue;
            }

            // User requested peace
            if ($user->getDoNotDisturb()) {
                $this->agi->notice("Skipping user %s with DND enabled.", $user);
                continue;
            }

            array_push($huntGroupEndpoints, 'PJSIP/' . $user->getEndpoint()->getSorceryId());
            array_push($huntGroupTimeouts, $entry->getTimeoutTime());
        }

// @TODO (Process empty huntgroup??)

        // Anyone is available?
//        if (empty($callEndpoints)) {
//            $this->agi->verbose("Huntgroup is empty or users are invalid.");
//            return;
//        }

        // Configure the list of users to be called
        if ($huntGroup->getStrategy() == HuntGroupAction::RingAll) {
            $this->agi->setVariable("HG_ID", $huntGroup->getId());
            $this->agi->setVariable("HG_ENDPOINTLIST", join($huntGroupEndpoints, '&'));
            $this->agi->setVariable("HG_TIMEOUTLIST", $huntGroup->getRingAllTimeout());
        } else {
            $this->agi->setVariable("HG_ID", $huntGroup->getId());
            $this->agi->setVariable("HG_ENDPOINTLIST", join($huntGroupEndpoints, ';'));
            $this->agi->setVariable("HG_TIMEOUTLIST", join($huntGroupTimeouts, ';'));
        }

        // Start calling the first user
        $this->agi->redirect('call-huntgroup');
    }
}
