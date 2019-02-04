<?php

namespace Ivoz\Provider\Domain\Model\RatingPlanGroup;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;

/**
 * RatingPlanGroupTrait
 * @codeCoverageIgnore
 */
trait RatingPlanGroupTrait
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var Collection
     */
    protected $ratingPlan;


    /**
     * Constructor
     */
    protected function __construct()
    {
        parent::__construct(...func_get_args());
        $this->ratingPlan = new ArrayCollection();
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
         * @var $dto RatingPlanGroupDto
         */
        $self = parent::fromDto($dto, $fkTransformer);
        if (!is_null($dto->getRatingPlan())) {
            $self->replaceRatingPlan(
                $fkTransformer->transformCollection(
                    $dto->getRatingPlan()
                )
            );
        }
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
         * @var $dto RatingPlanGroupDto
         */
        parent::updateFromDto($dto, $fkTransformer);
        if (!is_null($dto->getRatingPlan())) {
            $this->replaceRatingPlan(
                $fkTransformer->transformCollection(
                    $dto->getRatingPlan()
                )
            );
        }
        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return RatingPlanGroupDto
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
     * Add ratingPlan
     *
     * @param \Ivoz\Provider\Domain\Model\RatingPlan\RatingPlanInterface $ratingPlan
     *
     * @return RatingPlanGroupTrait
     */
    public function addRatingPlan(\Ivoz\Provider\Domain\Model\RatingPlan\RatingPlanInterface $ratingPlan)
    {
        $this->ratingPlan->add($ratingPlan);

        return $this;
    }

    /**
     * Remove ratingPlan
     *
     * @param \Ivoz\Provider\Domain\Model\RatingPlan\RatingPlanInterface $ratingPlan
     */
    public function removeRatingPlan(\Ivoz\Provider\Domain\Model\RatingPlan\RatingPlanInterface $ratingPlan)
    {
        $this->ratingPlan->removeElement($ratingPlan);
    }

    /**
     * Replace ratingPlan
     *
     * @param \Ivoz\Provider\Domain\Model\RatingPlan\RatingPlanInterface[] $ratingPlan
     * @return self
     */
    public function replaceRatingPlan(Collection $ratingPlan)
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($ratingPlan as $entity) {
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setRatingPlanGroup($this);
        }
        $updatedEntityKeys = array_keys($updatedEntities);

        foreach ($this->ratingPlan as $key => $entity) {
            $identity = $entity->getId();
            if (in_array($identity, $updatedEntityKeys)) {
                $this->ratingPlan->set($key, $updatedEntities[$identity]);
            } else {
                $this->ratingPlan->remove($key);
            }
            unset($updatedEntities[$identity]);
        }

        foreach ($updatedEntities as $entity) {
            $this->addRatingPlan($entity);
        }

        return $this;
    }

    /**
     * Get ratingPlan
     *
     * @return \Ivoz\Provider\Domain\Model\RatingPlan\RatingPlanInterface[]
     */
    public function getRatingPlan(Criteria $criteria = null)
    {
        if (!is_null($criteria)) {
            return $this->ratingPlan->matching($criteria)->toArray();
        }

        return $this->ratingPlan->toArray();
    }
}
