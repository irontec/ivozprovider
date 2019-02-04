<?php

namespace Ivoz\Provider\Domain\Model\RatingPlan;

use Ivoz\Core\Application\DataTransferObjectInterface;

/**
 * RatingPlanTrait
 * @codeCoverageIgnore
 */
trait RatingPlanTrait
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var \Ivoz\Cgr\Domain\Model\TpTiming\TpTimingInterface
     */
    protected $tpTiming;

    /**
     * @var \Ivoz\Cgr\Domain\Model\TpRatingPlan\TpRatingPlanInterface
     */
    protected $tpRatingPlan;


    /**
     * Constructor
     */
    protected function __construct()
    {
        parent::__construct(...func_get_args());
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param DataTransferObjectInterface $dto
     * @param \Ivoz\Core\Application\ForeignKeyTransformerInterface  $fkTransformer
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        /**
         * @var $dto RatingPlanDto
         */
        $self = parent::fromDto($dto, $fkTransformer);

        if ($dto->getId()) {
            $self->id = $dto->getId();
            $self->initChangelog();
        }

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param DataTransferObjectInterface $dto
     * @param \Ivoz\Core\Application\ForeignKeyTransformerInterface  $fkTransformer
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        /**
         * @var $dto RatingPlanDto
         */
        parent::updateFromDto($dto, $fkTransformer);

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
     * Set tpTiming
     *
     * @param \Ivoz\Cgr\Domain\Model\TpTiming\TpTimingInterface $tpTiming
     *
     * @return self
     */
    public function setTpTiming(\Ivoz\Cgr\Domain\Model\TpTiming\TpTimingInterface $tpTiming = null)
    {
        $this->tpTiming = $tpTiming;

        return $this;
    }

    /**
     * Get tpTiming
     *
     * @return \Ivoz\Cgr\Domain\Model\TpTiming\TpTimingInterface
     */
    public function getTpTiming()
    {
        return $this->tpTiming;
    }

    /**
     * Set tpRatingPlan
     *
     * @param \Ivoz\Cgr\Domain\Model\TpRatingPlan\TpRatingPlanInterface $tpRatingPlan
     *
     * @return self
     */
    public function setTpRatingPlan(\Ivoz\Cgr\Domain\Model\TpRatingPlan\TpRatingPlanInterface $tpRatingPlan = null)
    {
        $this->tpRatingPlan = $tpRatingPlan;

        return $this;
    }

    /**
     * Get tpRatingPlan
     *
     * @return \Ivoz\Cgr\Domain\Model\TpRatingPlan\TpRatingPlanInterface
     */
    public function getTpRatingPlan()
    {
        return $this->tpRatingPlan;
    }
}
