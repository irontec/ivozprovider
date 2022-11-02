<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\RoutingPatternGroup;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\RoutingPatternGroupsRelPattern\RoutingPatternGroupsRelPatternInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Selectable;
use Doctrine\Common\Collections\Criteria;
use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface;

/**
* @codeCoverageIgnore
*/
trait RoutingPatternGroupTrait
{
    /**
     * @var ?int
     */
    protected $id = null;

    /**
     * @var Collection<array-key, RoutingPatternGroupsRelPatternInterface> & Selectable<array-key, RoutingPatternGroupsRelPatternInterface>
     * RoutingPatternGroupsRelPatternInterface mappedBy routingPatternGroup
     * orphanRemoval
     */
    protected $relPatterns;

    /**
     * @var Collection<array-key, OutgoingRoutingInterface> & Selectable<array-key, OutgoingRoutingInterface>
     * OutgoingRoutingInterface mappedBy routingPatternGroup
     */
    protected $outgoingRoutings;

    /**
     * Constructor
     */
    protected function __construct()
    {
        parent::__construct(...func_get_args());
        $this->relPatterns = new ArrayCollection();
        $this->outgoingRoutings = new ArrayCollection();
    }

    abstract protected function sanitizeValues(): void;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param RoutingPatternGroupDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        /** @var static $self */
        $self = parent::fromDto($dto, $fkTransformer);
        $relPatterns = $dto->getRelPatterns();
        if (!is_null($relPatterns)) {

            /** @var Collection<array-key, RoutingPatternGroupsRelPatternInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $relPatterns
            );
            $self->replaceRelPatterns($replacement);
        }

        $outgoingRoutings = $dto->getOutgoingRoutings();
        if (!is_null($outgoingRoutings)) {

            /** @var Collection<array-key, OutgoingRoutingInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $outgoingRoutings
            );
            $self->replaceOutgoingRoutings($replacement);
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
     * @param RoutingPatternGroupDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        parent::updateFromDto($dto, $fkTransformer);
        $relPatterns = $dto->getRelPatterns();
        if (!is_null($relPatterns)) {

            /** @var Collection<array-key, RoutingPatternGroupsRelPatternInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $relPatterns
            );
            $this->replaceRelPatterns($replacement);
        }

        $outgoingRoutings = $dto->getOutgoingRoutings();
        if (!is_null($outgoingRoutings)) {

            /** @var Collection<array-key, OutgoingRoutingInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $outgoingRoutings
            );
            $this->replaceOutgoingRoutings($replacement);
        }
        $this->sanitizeValues();

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): RoutingPatternGroupDto
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

    public function addRelPattern(RoutingPatternGroupsRelPatternInterface $relPattern): RoutingPatternGroupInterface
    {
        $this->relPatterns->add($relPattern);

        return $this;
    }

    public function removeRelPattern(RoutingPatternGroupsRelPatternInterface $relPattern): RoutingPatternGroupInterface
    {
        $this->relPatterns->removeElement($relPattern);

        return $this;
    }

    /**
     * @param Collection<array-key, RoutingPatternGroupsRelPatternInterface> $relPatterns
     */
    public function replaceRelPatterns(Collection $relPatterns): RoutingPatternGroupInterface
    {
        foreach ($relPatterns as $entity) {
            $entity->setRoutingPatternGroup($this);
        }

        $toStringCallable = fn(mixed $val): \Stringable|string => $val instanceof \Stringable ? $val : serialize($val);
        foreach ($this->relPatterns as $key => $entity) {
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
            foreach ($relPatterns as $newKey => $newEntity) {
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
                    unset($relPatterns[$newKey]);
                    $match = true;
                    break;
                }
            }

            if (!$match) {
                $this->relPatterns->remove($key);
            }
        }

        foreach ($relPatterns as $entity) {
            $this->addRelPattern($entity);
        }

        return $this;
    }

    /**
     * @return array<array-key, RoutingPatternGroupsRelPatternInterface>
     */
    public function getRelPatterns(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->relPatterns->matching($criteria)->toArray();
        }

        return $this->relPatterns->toArray();
    }

    public function addOutgoingRouting(OutgoingRoutingInterface $outgoingRouting): RoutingPatternGroupInterface
    {
        $this->outgoingRoutings->add($outgoingRouting);

        return $this;
    }

    public function removeOutgoingRouting(OutgoingRoutingInterface $outgoingRouting): RoutingPatternGroupInterface
    {
        $this->outgoingRoutings->removeElement($outgoingRouting);

        return $this;
    }

    /**
     * @param Collection<array-key, OutgoingRoutingInterface> $outgoingRoutings
     */
    public function replaceOutgoingRoutings(Collection $outgoingRoutings): RoutingPatternGroupInterface
    {
        foreach ($outgoingRoutings as $entity) {
            $entity->setRoutingPatternGroup($this);
        }

        $toStringCallable = fn(mixed $val): \Stringable|string => $val instanceof \Stringable ? $val : serialize($val);
        foreach ($this->outgoingRoutings as $key => $entity) {
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
            foreach ($outgoingRoutings as $newKey => $newEntity) {
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
                    unset($outgoingRoutings[$newKey]);
                    $match = true;
                    break;
                }
            }

            if (!$match) {
                $this->outgoingRoutings->remove($key);
            }
        }

        foreach ($outgoingRoutings as $entity) {
            $this->addOutgoingRouting($entity);
        }

        return $this;
    }

    /**
     * @return array<array-key, OutgoingRoutingInterface>
     */
    public function getOutgoingRoutings(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->outgoingRoutings->matching($criteria)->toArray();
        }

        return $this->outgoingRoutings->toArray();
    }
}
