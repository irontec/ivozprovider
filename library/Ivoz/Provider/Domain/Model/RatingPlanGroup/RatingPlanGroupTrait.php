<?php
declare(strict_types = 1);

namespace Ivoz\Provider\Domain\Model\RatingPlanGroup;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\RatingPlan\RatingPlanInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;

/**
* @codeCoverageIgnore
*/
trait RatingPlanGroupTrait
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var ArrayCollection
     * RatingPlanInterface mappedBy ratingPlanGroup
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

    abstract protected function sanitizeValues();

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param RatingPlanGroupDto $dto
     * @param ForeignKeyTransformerInterface  $fkTransformer
     * @return static
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        /** @var static $self */
        $self = parent::fromDto($dto, $fkTransformer);
        if (!is_null($dto->getRatingPlan())) {
            $self->replaceRatingPlan(
                $fkTransformer->transformCollection(
                    $dto->getRatingPlan()
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
     * @param RatingPlanGroupDto $dto
     * @param ForeignKeyTransformerInterface  $fkTransformer
     * @return static
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        parent::updateFromDto($dto, $fkTransformer);
        if (!is_null($dto->getRatingPlan())) {
            $this->replaceRatingPlan(
                $fkTransformer->transformCollection(
                    $dto->getRatingPlan()
                )
            );
        }
        $this->sanitizeValues();

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

    public function addRatingPlan(RatingPlanInterface $ratingPlan): RatingPlanGroupInterface
    {
        $this->ratingPlan->add($ratingPlan);

        return $this;
    }

    public function removeRatingPlan(RatingPlanInterface $ratingPlan): RatingPlanGroupInterface
    {
        $this->ratingPlan->removeElement($ratingPlan);

        return $this;
    }

    public function replaceRatingPlan(ArrayCollection $ratingPlan): RatingPlanGroupInterface
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

    public function getRatingPlan(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->ratingPlan->matching($criteria)->toArray();
        }

        return $this->ratingPlan->toArray();
    }
}
