<?php

namespace Agi\Action;

use Agi\Wrapper;
use Doctrine\Common\Collections\Criteria;
use Ivoz\Provider\Domain\Model\HuntGroup\HuntGroupInterface;
use Ivoz\Provider\Domain\Model\HuntGroupsRelUser\HuntGroupsRelUserInterface;

class HuntGroupAction
{
    /**
     * @var Wrapper
     */
    protected $agi;

    /**
     * @var HuntGroupInterface|null
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
        if ($huntGroup->getStrategy() == HuntGroupInterface::STRATEGY_RANDOM) {
            shuffle($huntGroupEntries);
        }

        // Check huntgroup users
        $huntGroupEndpoints = array();
        $huntGroupTimeouts = array();

        foreach ($huntGroupEntries as $entry) {
            array_push($huntGroupEndpoints, 'Local/' . $entry->getId() . '@call-huntgroup-member');
            array_push($huntGroupTimeouts, $entry->getTimeoutTime());
        }

        // Configure the list of users to be called
        if ($huntGroup->getStrategy() == HuntGroupInterface::STRATEGY_RINGALL) {
            $this->agi->setVariable("HG_ID", $huntGroup->getId());
            $this->agi->setVariable("HG_ENDPOINTLIST", join('&', $huntGroupEndpoints));
            $this->agi->setVariable("HG_TIMEOUTLIST", $huntGroup->getRingAllTimeout());
        } else {
            $this->agi->setVariable("HG_ID", $huntGroup->getId());
            $this->agi->setVariable("HG_ENDPOINTLIST", join(';', $huntGroupEndpoints));
            $this->agi->setVariable("HG_TIMEOUTLIST", join(';', $huntGroupTimeouts));
        }

        // Start calling the first user
        $this->agi->redirect('call-huntgroup');
    }
}
