<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\RatingProfile;

use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\ForeignKeyTransformerInterface;
use Ivoz\Cgr\Domain\Model\TpRatingProfile\TpRatingProfileInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Selectable;
use Doctrine\Common\Collections\Criteria;

/**
* @codeCoverageIgnore
*/
trait RatingProfileTrait
{
    /**
     * @var ?int
     */
    protected $id = null;

    /**
     * @var Collection<array-key, TpRatingProfileInterface> & Selectable<array-key, TpRatingProfileInterface>
     * TpRatingProfileInterface mappedBy ratingProfile
     */
    protected $tpRatingProfiles;

    /**
     * Constructor
     */
    protected function __construct()
    {
        parent::__construct(...func_get_args());
        $this->tpRatingProfiles = new ArrayCollection();
    }

    abstract protected function sanitizeValues(): void;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param RatingProfileDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        /** @var static $self */
        $self = parent::fromDto($dto, $fkTransformer);
        $tpRatingProfiles = $dto->getTpRatingProfiles();
        if (!is_null($tpRatingProfiles)) {

            /** @var Collection<array-key, TpRatingProfileInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $tpRatingProfiles
            );
            $self->replaceTpRatingProfiles($replacement);
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
     * @param RatingProfileDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        parent::updateFromDto($dto, $fkTransformer);
        $tpRatingProfiles = $dto->getTpRatingProfiles();
        if (!is_null($tpRatingProfiles)) {

            /** @var Collection<array-key, TpRatingProfileInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $tpRatingProfiles
            );
            $this->replaceTpRatingProfiles($replacement);
        }
        $this->sanitizeValues();

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): RatingProfileDto
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

    public function addTpRatingProfile(TpRatingProfileInterface $tpRatingProfile): RatingProfileInterface
    {
        $this->tpRatingProfiles->add($tpRatingProfile);

        return $this;
    }

    public function removeTpRatingProfile(TpRatingProfileInterface $tpRatingProfile): RatingProfileInterface
    {
        $this->tpRatingProfiles->removeElement($tpRatingProfile);

        return $this;
    }

    /**
     * @param Collection<array-key, TpRatingProfileInterface> $tpRatingProfiles
     */
    public function replaceTpRatingProfiles(Collection $tpRatingProfiles): RatingProfileInterface
    {
        foreach ($tpRatingProfiles as $entity) {
            $entity->setRatingProfile($this);
        }

        $toStringCallable = fn(mixed $val): \Stringable|string => $val instanceof \Stringable ? $val : serialize($val);
        foreach ($this->tpRatingProfiles as $key => $entity) {
            /**
             * @psalm-suppress MixedArgument
             */
            $currentValue = array_map(
                $toStringCallable,
                (function (): array {
                    return $this->__toArray(); /** @phpstan-ignore-line */
                })->call($entity)
            );

            $match = false;
            foreach ($tpRatingProfiles as $newKey => $newEntity) {
                /**
                 * @psalm-suppress MixedArgument
                 */
                $newValue = array_map(
                    $toStringCallable,
                    (function (): array {
                        return $this->__toArray(); /** @phpstan-ignore-line */
                    })->call($newEntity)
                );

                $diff = array_diff_assoc(
                    $currentValue,
                    $newValue
                );
                unset($diff['id']);

                if (empty($diff)) {
                    unset($tpRatingProfiles[$newKey]);
                    $match = true;
                    break;
                }
            }

            if (!$match) {
                $this->tpRatingProfiles->remove($key);
            }
        }

        foreach ($tpRatingProfiles as $entity) {
            $this->addTpRatingProfile($entity);
        }

        return $this;
    }

    /**
     * @return array<array-key, TpRatingProfileInterface>
     */
    public function getTpRatingProfiles(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->tpRatingProfiles->matching($criteria)->toArray();
        }

        return $this->tpRatingProfiles->toArray();
    }
}
