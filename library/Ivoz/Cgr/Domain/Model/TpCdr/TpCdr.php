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
    public function getId(): ?int
    {
        return $this->id;
    }

    public function initChangelog(): void
    {
        /** @var array|null $costDetails */
        $costDetails = $this->costDetails;
        if (is_null($costDetails)) {
            // NOT NULL constraint is not being met under some circumstances
            $this->setCostDetails([]);
        }

        parent::initChangelog();
    }

    public function getDuration(): ?float
    {
        $usage = $this->getUsage();
        if (!$usage) {
            return null;
        }

        return floatval($usage) / 1000_000_000;
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

        $timespans = $costDetails['Timespans'] ?? [];

        return current($timespans);
    }

    /**
     * @return \DateTime | null
     */
    public function getStartTime()
    {
        $timespan = $this->getCostDetailsFirstTimespan();
        if (!$timespan) {
            return null;
        }

        return \DateTime::createFromFormat(
            'Y-m-d\TH:i:s\Z',
            $timespan['TimeStart'],
            new \DateTimeZone('UTC')
        );
    }

    /**
     * @return string
     */
    public function getRatingPlanTag(): string
    {
        $timespan = $this->getCostDetailsFirstTimespan();
        if (!$timespan) {
            return '';
        }

        return $timespan['RatingPlanId'] ?? '';
    }

    /**
     * @return string
     */
    public function getMatchedDestinationTag(): string
    {
        $timespan = $this->getCostDetailsFirstTimespan();
        if (!$timespan) {
            return '';
        }

        return $timespan['MatchedDestId'] ?? '';
    }
}
