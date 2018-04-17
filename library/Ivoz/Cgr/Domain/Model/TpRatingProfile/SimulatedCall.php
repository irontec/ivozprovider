<?php

namespace Ivoz\Cgr\Domain\Model\TpRatingProfile;

use Ivoz\Cgr\Domain\Model\RatingPlan\RatingPlanDto;
use Ivoz\Cgr\Domain\Model\TpDestinationRate\TpDestinationRate;
use Ivoz\Cgr\Domain\Model\TpDestinationRate\TpDestinationRateRepository;
use Ivoz\Cgr\Domain\Model\TpRatingPlan\TpRatingPlan;
use Ivoz\Cgr\Domain\Model\TpRatingPlan\TpRatingPlanRepository;
use Ivoz\Core\Application\Service\EntityTools;

/**
 * SimulatedCall
 */
class SimulatedCall
{
    /**
     * @var \DateTime
     */
    protected $callDate;

    /**
     * @var int
     */
    protected $callDuration;

    /**
     * @var RatingPlanDto
     */
    protected $ratingPlan;

    /**
     * @var string
     */
    protected $patternName;

    /**
     * @var string
     */
    protected $prefix;

    /**
     * @var float
     */
    protected $connectionFee;

    /**
     * @var int
     */
    protected $chargePeriod;

    /**
     * @var float
     */
    protected $rate;

    /**
     * @var float
     */
    protected $cost;

    private function __construct() {}

    public static function fromCgRatesResponse(
        string $response,
        EntityTools $entityTools
    ) {
        /** @var TpRatingPlanRepository $tpRatingPlanRepository */
        $tpRatingPlanRepository = $entityTools->getRepository(TpRatingPlan::class);
        /** @var TpDestinationRateRepository $tpDestinationRateRepository */
        $tpDestinationRateRepository = $entityTools->getRepository(TpDestinationRate::class);

        $instance = new static();
        $response = json_decode($response);

        if ($response->error) {
            throw new \DomainException($response->error);
        }

        try {
            $result = $response->result;
            $instance->callDate = \DateTime::createFromFormat(
                'Y-m-d\TH:i:s\Z',
                $result->StartTime,
                new \DateTimeZone('UTC')
            );
            $instance->callDuration = substr($result->Usage, 0, -9);

            $ratingId = $result->Charges[0]->RatingID;
            $rateId = $result->Rating->{$ratingId}->RatesID;
            $ratingFilterId = $result->Rating->{$ratingId}->RatingFiltersID;

            $instance->connectionFee = $result->Rating->{$ratingId}->ConnectFee;
            $instance->prefix = $result->RatingFilters->{$ratingFilterId}->DestinationPrefix;
            $instance->chargePeriod = substr($result->Charges[0]->Increments[0]->Usage, 0, -9);
            $instance->rate = $result->Charges[0]->Increments[0]->Cost;
            $instance->cost = $result->Cost;

            /** @var TpRatingPlan $tpRatingPlan */
            $tpRatingPlan = $tpRatingPlanRepository->findOneBy([
                'tag' => $result->RatingFilters->{$ratingFilterId}->RatingPlanID
            ]);

            /** @var RatingPlanDto ratingPlan */
            $instance->ratingPlan = $entityTools->entityToDto(
                $tpRatingPlan->getRatingPlan()
            );

            $destinationTag = $result->RatingFilters->{$ratingFilterId}->DestinationID;

            /** @var TpDestinationRate $tpDestinationRate */
            $tpDestinationRate = $tpDestinationRateRepository->findOneBy([
                'destinationsTag' => $destinationTag
            ]);

            $instance->patternName = $tpDestinationRate
                ->getDestination()
                ->getPrefixName();

            return $instance;

        } catch (\Exception $e) {

            throw new \DomainException(
                $e->getMessage(),
                $e->getCode(),
                $e
            );
        }
    }

    /**
     * @return \DateTime
     */
    public function getCallDate(): \DateTime
    {
        return $this->callDate;
    }

    /**
     * @return int
     */
    public function getCallDuration(): int
    {
        return $this->callDuration;
    }

    /**
     * @return RatingPlanDto
     */
    public function getRatingPlan(): RatingPlanDto
    {
        return $this->ratingPlan;
    }

    /**
     * @return string
     */
    public function getPatternName(): string
    {
        return $this->patternName;
    }

    /**
     * @return string
     */
    public function getPrefix(): string
    {
        return $this->prefix;
    }

    /**
     * @return float
     */
    public function getConnectionFee(): float
    {
        return $this->connectionFee;
    }

    /**
     * @return int
     */
    public function getChargePeriod(): int
    {
        return $this->chargePeriod;
    }

    /**
     * @return float
     */
    public function getRate(): float
    {
        return $this->rate;
    }

    /**
     * @return float
     */
    public function getCost(): float
    {
        return $this->cost;
    }
}

