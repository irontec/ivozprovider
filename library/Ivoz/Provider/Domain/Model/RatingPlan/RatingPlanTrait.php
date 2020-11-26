<?php
declare(strict_types = 1);

namespace Ivoz\Provider\Domain\Model\RatingPlan;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Cgr\Domain\Model\TpTiming\TpTimingInterface;
use Ivoz\Cgr\Domain\Model\TpRatingPlan\TpRatingPlanInterface;

/**
* @codeCoverageIgnore
*/
trait RatingPlanTrait
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var TpTimingInterface
     * mappedBy ratingPlan
     */
    protected $tpTiming;

    /**
     * @var TpRatingPlanInterface
     * mappedBy ratingPlan
     */
    protected $tpRatingPlan;

    /**
     * Constructor
     */
    protected function __construct()
    {
        parent::__construct(...func_get_args());

    }

    abstract protected function sanitizeValues();

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param RatingPlanDto $dto
     * @param ForeignKeyTransformerInterface  $fkTransformer
     * @return static
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        /** @var static $self */
        $self = parent::fromDto($dto, $fkTransformer);
        if (!is_null($dto->getTpTiming())) {
            $self->setTpTiming(
                $fkTransformer->transform(
                    $dto->getTpTiming()
                )
            );
        }

        if (!is_null($dto->getTpRatingPlan())) {
            $self->setTpRatingPlan(
                $fkTransformer->transform(
                    $dto->getTpRatingPlan()
                )
            );
        }

        $self->sanitizeValues();
        if ($dto->getId()) {
            $self->id = $dto->getId();
            $self->initChangelog();
        }

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param RatingPlanDto $dto
     * @param ForeignKeyTransformerInterface  $fkTransformer
     * @return static
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        parent::updateFromDto($dto, $fkTransformer);
        if (!is_null($dto->getTpTiming())) {
            $this->setTpTiming(
                $fkTransformer->transform(
                    $dto->getTpTiming()
                )
            );
        }

        if (!is_null($dto->getTpRatingPlan())) {
            $this->setTpRatingPlan(
                $fkTransformer->transform(
                    $dto->getTpRatingPlan()
                )
            );
        }
        $this->sanitizeValues();

        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return RatingPlanDto
     */
    public function toDto($depth = 0)
    {
        $dto = parent::toDto($depth);
        return $dto
            ->setId($this->getId());
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return parent::__toArray() + [
            'id' => self::getId()
        ];
    }

    /**
     * @var TpTimingInterface
     * mappedBy ratingPlan
     */
    public function setTpTiming(TpTimingInterface $tpTiming): RatingPlanInterface
    {
        $this->tpTiming = $tpTiming;

        return $this;
    }

    /**
     * Get tpTiming
     * @return TpTimingInterface
     */
    public function getTpTiming(): ?TpTimingInterface
    {
        return $this->tpTiming;
    }

    /**
     * @var TpRatingPlanInterface
     * mappedBy ratingPlan
     */
    public function setTpRatingPlan(TpRatingPlanInterface $tpRatingPlan): RatingPlanInterface
    {
        $this->tpRatingPlan = $tpRatingPlan;

        return $this;
    }

    /**
     * Get tpRatingPlan
     * @return TpRatingPlanInterface
     */
    public function getTpRatingPlan(): ?TpRatingPlanInterface
    {
        return $this->tpRatingPlan;
    }

}
