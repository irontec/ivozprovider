<?php

namespace Ivoz\Provider\Domain\Model\RatingPlanGroup;

use Ivoz\Api\Core\Annotation\AttributeDefinition;
use Ivoz\Cgr\Domain\Model\TpRatingProfile\SimulatedCall;

class TarificationInfo
{
    /**
     * @var string
     * @AttributeDefinition(type="string")
     */
    private $plan;

    /**
     * @var string
     * @AttributeDefinition(type="string")
     */
    private $callDate;

    /**
     * @var int
     * @AttributeDefinition(type="int")
     */
    private $duration;

    /**
     * @var string
     * @AttributeDefinition(type="string")
     */
    private $patternName;

    /**
     * @var float
     * @AttributeDefinition(type="float")
     */
    private $connectionCharge;

    /**
     * @var string
     * @AttributeDefinition(type="string")
     */
    private $intervalStart;

    /**
     * @var float
     * @AttributeDefinition(type="float")
     */
    private $rate;

    /**
     * @var int
     * @AttributeDefinition(type="int")
     */
    private $ratePeriod;

    /**
     * @var float
     * @AttributeDefinition(type="float")
     */
    private $totalCost;

    /**
     * @var string
     * @AttributeDefinition(type="string")
     */
    private $currencySymbol;

    public function __construct(
        string $plan,
        string $callDate,
        int $duration,
        string $patternName,
        float $connectionCharge,
        string $intervalStart,
        float $rate,
        int $ratePeriod,
        float $totalCost,
        string $currencySymbol
    ) {
        $this->plan = $plan;
        $this->callDate = $callDate;
        $this->duration = $duration;
        $this->patternName = $patternName;
        $this->connectionCharge = $connectionCharge;
        $this->intervalStart = $intervalStart;
        $this->rate = $rate;
        $this->ratePeriod = $ratePeriod;
        $this->totalCost = $totalCost;
        $this->currencySymbol = $currencySymbol;
    }

    /**
     * @psalm-suppress UnusedMethodCall
     */
    public static function fromSimulatedCall(
        SimulatedCall $simulatedCall,
        string $currencySymbol
    ): self {
        $ratingPlanGroupDto = $simulatedCall->getRatingPlanGroup();
        $ratingPlanGroupName = ($ratingPlanGroupDto)
            ? $ratingPlanGroupDto->getNameEn()
            : "";

        if ($simulatedCall->getErrorMessage()) {
            switch ($simulatedCall->getErrorCode()) {
                case SimulatedCall::ERROR_UNAUTHORIZED_DESTINATION:
                    throw new \DomainException('Active pricing plan does not allow to call introduced phone number');
                case SimulatedCall::ERROR_NO_RATING_PLAN;
                    throw new \DomainException('Destination rate not found');
                default:
                    throw new \DomainException('Unexpected rate error');
            }
        }

        $cost = $simulatedCall->getCost() + $simulatedCall->getConnectionFee();

        $callDate = $simulatedCall->getCallDate();
        $callDate
            ->setTimezone(
                new \DateTimeZone(date_default_timezone_get())
            );

        if (!$ratingPlanGroupName) {
            throw new \DomainException('Rating Plan Group Name cannot be null', 400);
        }

        return new self(
            $ratingPlanGroupName,
            $callDate->format('Y-m-d H:i:s'),
            $simulatedCall->getCallDuration(),
            $simulatedCall->getPatternName() . ' (' . $simulatedCall->getPrefix() . ')',
            $simulatedCall->getConnectionFee(),
            $simulatedCall->getIntervalStart(),
            $simulatedCall->getRate(),
            $simulatedCall->getChargePeriod(),
            $cost,
            $currencySymbol
        );
    }

    /**
     * @return array<string, float|int|string>
     */
    public function toArray(): array
    {
        return [
            'plan' => $this->getPlan(),
            'callDate' => $this->getCallDate(),
            'duration' => $this->getDuration(),
            'patternName' => $this->getPatternName(),
            'connectionCharge' => $this->getConnectionCharge(),
            'intervalStart' => $this->getIntervalStart(),
            'rate' => $this->getRate(),
            'ratePeriod' => $this->getRatePeriod(),
            'totalCost' => $this->getTotalCost(),
            'currencySymbol' => $this->getCurrencySymbol(),
        ];
    }

    public function getPlan(): string
    {
        return $this->plan;
    }

    public function getCallDate(): string
    {
        return $this->callDate;
    }

    public function getDuration(): int
    {
        return $this->duration;
    }

    public function getPatternName(): string
    {
        return $this->patternName;
    }

    public function getConnectionCharge(): float
    {
        return $this->connectionCharge;
    }

    public function getIntervalStart(): string
    {
        return $this->intervalStart;
    }

    public function getRate(): float
    {
        return $this->rate;
    }

    public function getRatePeriod(): int
    {
        return $this->ratePeriod;
    }

    public function getTotalCost(): float
    {
        return $this->totalCost;
    }

    public function getCurrencySymbol(): string
    {
        return $this->currencySymbol;
    }
}
