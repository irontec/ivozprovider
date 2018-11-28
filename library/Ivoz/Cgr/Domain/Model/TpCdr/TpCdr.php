<?php

namespace Ivoz\Cgr\Domain\Model\TpCdr;

/**
 * TpCdr
 */
class TpCdr extends TpCdrAbstract implements TpCdrInterface
{
    use TpCdrTrait;

    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    public function getDuration()
    {
        $usage = $this->getUsage();
        if (!$usage) {
            return null;
        }

        return $usage / (1000 * 1000 * 1000);
    }

    /**
     * @return array|null
     */
    public function getCostDetailsFirstTimespan()
    {
        $costDetails = $this->getCostDetails();
        if (empty($costDetails)) {
            return null;
        }

        $timespans = $costDetails['Timespans'];

        return current($timespans);
    }

    /**
     * @return \DateTime
     */
    public function getStartTime()
    {
        $timespan = $this->getCostDetailsFirstTimespan();
        if (!$timespan) {
            return;
        }

        return new \DateTime($timespan['TimeStart']);
    }

    /**
     * @return string
     */
    public function getRatingPlanTag()
    {
        $timespan = $this->getCostDetailsFirstTimespan();
        if (!$timespan) {
            return;
        }

        return $timespan['RatingPlanId'];
    }

    /**
     * @return string
     */
    public function getMatchedDestinationTag()
    {
        $timespan = $this->getCostDetailsFirstTimespan();
        if (!$timespan) {
            return;
        }

        return $timespan['MatchedDestId'];
    }
}
