<?php

namespace Ivoz\Cgr\Domain\Model\TpRatingProfile;

use Ivoz\Cgr\Domain\Model\TpDestination\TpDestination;
use Ivoz\Cgr\Domain\Model\TpDestination\TpDestinationInterface;
use Ivoz\Cgr\Domain\Model\TpDestination\TpDestinationRepository;
use Ivoz\Cgr\Domain\Model\TpDestinationRate\TpDestinationRateInterface;
use Ivoz\Cgr\Domain\Model\TpRatingPlan\TpRatingPlan;
use Ivoz\Cgr\Domain\Model\TpRatingPlan\TpRatingPlanDto;
use Ivoz\Cgr\Domain\Model\TpRatingPlan\TpRatingPlanRepository;
use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\RatingPlan\RatingPlanDto;
use Ivoz\Provider\Domain\Model\RatingPlanGroup\RatingPlanGroupDto;

/**
 * SimulatedCall
 */
class SimulatedCall
{
    public const ERROR_UNAUTHORIZED_DESTINATION = 1;
    public const ERROR_UNAUTHORIZED_DESTINATION_MSG = 'SERVER_ERROR: UNAUTHORIZED_DESTINATION';
    public const ERROR_NO_RATING_PLAN = 2;
    public const ERROR_NO_RATING_PLAN_MSG = 'NOT_FOUND:RatingPlanId:';
    public const FALLBACK_ERROR_MSG = 'There was a problem';

    /** @var int|string */
    private $errorCode;

    /**
     * @var string
     */
    private $errorMessage;

    /**
     * @var \DateTime
     */
    private $callDate;

    /**
     * @var int
     */
    private $callDuration;

    /**
     * @var RatingPlanGroupDto
     */
    private $ratingPlanGroupDto;

    /**
     * @var TpRatingPlanDto
     */
    private $tpRatingPlanDto;

    /**
     * @var string
     */
    private $patternName;

    /**
     * @var string
     */
    private $prefix;

    /**
     * @var string
     */
    private $intervalStart;

    /**
     * @var float
     */
    private $connectionFee;

    /**
     * @var int
     */
    private $chargePeriod;

    /**
     * @var float
     */
    private $rate;

    /**
     * @var float
     */
    private $cost;

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
        $response = json_decode($response, null, 512, JSON_THROW_ON_ERROR);

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

        $connectFeeIsMinCost = $result->Rating->{$ratingId}->RoundingMethod === TpDestinationRateInterface::ROUNDINGMETHOD_UPMINCOST;
        if ($connectFeeIsMinCost) {
            $minCost = $result->Rating->{$ratingId}->ConnectFee;
            $instance->connectionFee = ($result->Cost > $minCost) ? 0 : $minCost - $result->Cost;
        }

        $precision = $result->Rating->{$ratingId}->RoundingDecimals;
        $instance->cost = ceil($instance->cost * pow(10, $precision)) / pow(10, $precision);

        $tag = $result->RatingFilters->{$ratingFilterId}->RatingPlanID;

        $tpRatingPlan = $tpRatingPlanRepository
            ->findOneByTag($tag);

        if (!$tpRatingPlan) {
            throw new \DomainException(self::FALLBACK_ERROR_MSG);
        }

        /** @var RatingPlanGroupDto $ratingPlanGroupDto */
        $ratingPlanGroupDto = $entityTools->entityToDto(
            $tpRatingPlan->getRatingPlan()->getRatingPlanGroup()
        );
        $instance->ratingPlanGroupDto = $ratingPlanGroupDto;
        $destinationTag = $result->RatingFilters->{$ratingFilterId}->DestinationID;

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

        $tpRatingPlan = $tpRatingPlansRepository->findOneByTag($ratingPlanTag);

        if ($tpRatingPlan) {
            /** @var TpRatingPlanDto $tpRatingPlanDto */
            $tpRatingPlanDto = $entityTools->entityToDto($tpRatingPlan);
            $instance->tpRatingPlanDto = $tpRatingPlanDto;
        }

        if ($errorMsg === self::ERROR_UNAUTHORIZED_DESTINATION_MSG) {
            $instance->errorCode = self::ERROR_UNAUTHORIZED_DESTINATION;

            return $instance;
        }

        $emptyDestinationRateMsg = self::ERROR_NO_RATING_PLAN_MSG;
        if (str_starts_with($errorMsg, $emptyDestinationRateMsg)) {
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
     * @return \DateTime|\DateTimeImmutable
     */
    public function getCallDate(): \DateTimeInterface
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
    public function getIntervalStart(): string
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
