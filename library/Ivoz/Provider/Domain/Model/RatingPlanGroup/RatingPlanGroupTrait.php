<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\RatingPlanGroup;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\RatingPlan\RatingPlanInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Selectable;
use Doctrine\Common\Collections\Criteria;

/**
* @codeCoverageIgnore
*/
trait RatingPlanGroupTrait
{
    /**
     * @var ?int
     */
    protected $id = null;

    /**
     * @var Collection<array-key, RatingPlanInterface> & Selectable<array-key, RatingPlanInterface>
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

    abstract protected function sanitizeValues(): void;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param RatingPlanGroupDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        /** @var static $self */
        $self = parent::fromDto($dto, $fkTransformer);
        $ratingPlan = $dto->getRatingPlan();
        if (!is_null($ratingPlan)) {

            /** @var Collection<array-key, RatingPlanInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $ratingPlan
            );
            $self->replaceRatingPlan($replacement);
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
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        parent::updateFromDto($dto, $fkTransformer);
        $ratingPlan = $dto->getRatingPlan();
        if (!is_null($ratingPlan)) {

            /** @var Collection<array-key, RatingPlanInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $ratingPlan
            );
            $this->replaceRatingPlan($replacement);
        }
        $this->sanitizeValues();

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): RatingPlanGroupDto
    {
        $dto = parent::toDto($depth);
        return $dto
            ->setId($this->getId());
    }

    /**
     * @return array<string, mixed>
     */
    protected function __toArray(): array
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

    /**
     * @param Collection<array-key, RatingPlanInterface> $ratingPlan
     */
    public function replaceRatingPlan(Collection $ratingPlan): RatingPlanGroupInterface
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($ratingPlan as $entity) {
            /** @var string|int $index */
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setRatingPlanGroup($this);
        }

        foreach ($this->ratingPlan as $key => $entity) {
            $identity = $entity->getId();
            if (!$identity) {
                $this->ratingPlan->remove($key);
                continue;
            }

            if (array_key_exists($identity, $updatedEntities)) {
                $this->ratingPlan->set($key, $updatedEntities[$identity]);
                unset($updatedEntities[$identity]);
            } else {
                $this->ratingPlan->remove($key);
            }
        }

        foreach ($updatedEntities as $entity) {
            $this->addRatingPlan($entity);
        }

        return $this;
    }

    /**
     * @return array<array-key, RatingPlanInterface>
     */
    public function getRatingPlan(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->ratingPlan->matching($criteria)->toArray();
        }

        return $this->ratingPlan->toArray();
    }
}
