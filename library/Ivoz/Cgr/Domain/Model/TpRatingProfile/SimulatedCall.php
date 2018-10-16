<?php

namespace Ivoz\Cgr\Domain\Model\TpRatingProfile;

use Ivoz\Cgr\Domain\Model\TpDestination\TpDestination;
use Ivoz\Cgr\Domain\Model\TpDestination\TpDestinationInterface;
use Ivoz\Cgr\Domain\Model\TpDestination\TpDestinationRepository;
use Ivoz\Provider\Domain\Model\RatingPlan\RatingPlanDto;
use Ivoz\Cgr\Domain\Model\TpRatingPlan\TpRatingPlan;
use Ivoz\Cgr\Domain\Model\TpRatingPlan\TpRatingPlanRepository;
use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\RatingPlanGroup\RatingPlanGroupDto;

/**
 * SimulatedCall
 */
class SimulatedCall
{
    const ERROR_UNAUTHORIZED_DESTINATION = 1;
    const ERROR_NO_RATING_PLAN = 2;
    const FALLBACK_ERROR_MSG = 'There was a problem';

    protected $errorCode;

    /**
     * @var string
     */
    protected $errorMessage;

    /**
     * @var \DateTime
     */
    protected $callDate;

    /**
     * @var int
     */
    protected $callDuration;

    /**
     * @var RatingPlanGroupDto
     */
    protected $ratingPlanGroupDto;

    /**
     * @var string
     */
    protected $patternName;

    /**
     * @var string
     */
    protected $prefix;

    /**
     * @var string
     */
    protected $intervalStart;

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

    private function __construct()
    {
    }

    /**
     * @param string $response
     * @param int $duration
     * @param EntityTools $entityTools
     * @return SimulatedCall
     */
    public static function fromCgRatesResponse(
        string $response,
        int $duration,
        EntityTools $entityTools
    ) {
        $response = json_decode($response);

        /** @var TpRatingPlanRepository $tpRatingPlanRepository */
        $tpRatingPlanRepository = $entityTools->getRepository(TpRatingPlan::class);

        /** @var TpDestinationRepository $tpDestinationRepository */
        $tpDestinationRepository = $entityTools->getRepository(TpDestination::class);

        if ($response->error) {
            throw new \RuntimeException($response->error);
        }

        $instance = new static();
        $instance->callDuration = $duration;

        $result = $response->result;
        $instance->callDate = \DateTime::createFromFormat(
            'Y-m-d\TH:i:s\Z',
            $result->StartTime,
            new \DateTimeZone('UTC')
        );

        $ratingId = $result->Charges[0]->RatingID;
        $rateId = $result->Rating->{$ratingId}->RatesID;
        $ratingFilterId = $result->Rating->{$ratingId}->RatingFiltersID;

        $instance->connectionFee = $result->Rating->{$ratingId}->ConnectFee;
        $instance->prefix = $result->RatingFilters->{$ratingFilterId}->DestinationPrefix;

        $charge = end($result->Charges);
        $instance->chargePeriod = isset($charge->Increments)
            ? substr($charge->Increments[0]->Usage, 0, -9)
            : 0;

        $rates = $result->Rates->{$rateId};

        $interval = $rates[0]->GroupIntervalStart > 0
            ? substr($rates[0]->GroupIntervalStart, 0, -9)
            : '0';
        $instance->intervalStart = $interval;

        $instance->rate = isset($charge->Increments)
            ? $charge->Increments[0]->Cost
            : 0;

        $instance->cost = $result->Cost;

        $precision = $result->Rating->{$ratingId}->RoundingDecimals;
        $instance->cost = ceil($instance->cost * pow(10, $precision)) / pow(10, $precision);

        $tag = $result->RatingFilters->{$ratingFilterId}->RatingPlanID;
        /** @var TpRatingPlan $tpRatingPlan */
        $tpRatingPlan = $tpRatingPlanRepository
            ->findOneByTag($tag);

        if (!$tpRatingPlan) {
            throw new \DomainException(self::FALLBACK_ERROR_MSG);
        }

        /** @var RatingPlanDto ratingPlan */
        $instance->ratingPlanGroupDto = $entityTools->entityToDto(
            $tpRatingPlan->getRatingPlan()->getRatingPlanGroup()
        );
        $destinationTag = $result->RatingFilters->{$ratingFilterId}->DestinationID;

        /** @var TpDestinationInterface $tpDestination */
        $tpDestination = $tpDestinationRepository
            ->findOneByTag($destinationTag);

        if (!$tpDestination) {
            throw new \DomainException(self::FALLBACK_ERROR_MSG);
        }

        $destination = $tpDestination->getDestination();
        $brandLanguageCode = $destination->getBrand()->getLanguageCode();
        $getter = 'get' . $brandLanguageCode;

        $instance->patternName = $tpDestination
            ->getDestination()
            ->getName()
            ->{$getter}();

        return $instance;
    }

    /**
     * @param string $errorMsg
     * @param string $ratingPlanTag
     * @param EntityTools $entityTools
     * @return static
     * @throws \Exception
     */
    public static function fromErrorResponse(
        string $errorMsg,
        string $ratingPlanTag,
        EntityTools $entityTools
    ) {
        $instance = new static();

        $instance->errorMessage = $errorMsg;

        /** @var TpRatingPlanRepository $tpRatingPlansRepository */
        $tpRatingPlansRepository = $entityTools->getRepository(TpRatingPlan::class);

        /** @var TpRatingPlan $tpRatingPlan */
        $tpRatingPlan = $tpRatingPlansRepository->findOneByTag($ratingPlanTag);

        $instance->tpRatingPlanDto = $entityTools->entityToDto($tpRatingPlan);

        if ($errorMsg === 'SERVER_ERROR: UNAUTHORIZED_DESTINATION') {
            $instance->errorCode = self::ERROR_UNAUTHORIZED_DESTINATION;
            return $instance;
        }

        $emptyDestinationRateMsg = 'NOT_FOUND:RatingPlanId:';
        if (substr($errorMsg, 0, strlen($emptyDestinationRateMsg)) === $emptyDestinationRateMsg) {
            $instance->errorCode = self::ERROR_NO_RATING_PLAN;
            return $instance;
        }

        throw new \Exception(self::FALLBACK_ERROR_MSG);
    }

    /**
     * @return int | null
     */
    public function getErrorCode()
    {
        return $this->errorCode;
    }

    /**
     * @return string | null
     */
    public function getErrorMessage()
    {
        return $this->errorMessage;
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
     * @return RatingPlanGroupDto | null
     */
    public function getRatingPlanGroup()
    {
        return $this->ratingPlanGroupDto;
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
     * @return string
     */
    public function getIntervalStart() :string
    {
        return $this->intervalStart;
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
