<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\RoutingPattern;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Selectable;
use Doctrine\Common\Collections\Criteria;
use Ivoz\Provider\Domain\Model\RoutingPatternGroupsRelPattern\RoutingPatternGroupsRelPatternInterface;
use Ivoz\Kam\Domain\Model\TrunksLcrRule\TrunksLcrRuleInterface;

/**
* @codeCoverageIgnore
*/
trait RoutingPatternTrait
{
    /**
     * @var ?int
     */
    protected $id = null;

    /**
     * @var Collection<array-key, OutgoingRoutingInterface> & Selectable<array-key, OutgoingRoutingInterface>
     * OutgoingRoutingInterface mappedBy routingPattern
     */
    protected $outgoingRoutings;

    /**
     * @var Collection<array-key, RoutingPatternGroupsRelPatternInterface> & Selectable<array-key, RoutingPatternGroupsRelPatternInterface>
     * RoutingPatternGroupsRelPatternInterface mappedBy routingPattern
     * orphanRemoval
     */
    protected $relPatternGroups;

    /**
     * @var Collection<array-key, TrunksLcrRuleInterface> & Selectable<array-key, TrunksLcrRuleInterface>
     * TrunksLcrRuleInterface mappedBy routingPattern
     */
    protected $lcrRules;

    /**
     * Constructor
     */
    protected function __construct()
    {
        parent::__construct(...func_get_args());
        $this->outgoingRoutings = new ArrayCollection();
        $this->relPatternGroups = new ArrayCollection();
        $this->lcrRules = new ArrayCollection();
    }

    abstract protected function sanitizeValues(): void;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param RoutingPatternDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        /** @var static $self */
        $self = parent::fromDto($dto, $fkTransformer);
        $outgoingRoutings = $dto->getOutgoingRoutings();
        if (!is_null($outgoingRoutings)) {

            /** @var Collection<array-key, OutgoingRoutingInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $outgoingRoutings
            );
            $self->replaceOutgoingRoutings($replacement);
        }

        $relPatternGroups = $dto->getRelPatternGroups();
        if (!is_null($relPatternGroups)) {

            /** @var Collection<array-key, RoutingPatternGroupsRelPatternInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $relPatternGroups
            );
            $self->replaceRelPatternGroups($replacement);
        }

        $lcrRules = $dto->getLcrRules();
        if (!is_null($lcrRules)) {

            /** @var Collection<array-key, TrunksLcrRuleInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $lcrRules
            );
            $self->replaceLcrRules($replacement);
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
     * @param RoutingPatternDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        parent::updateFromDto($dto, $fkTransformer);
        $outgoingRoutings = $dto->getOutgoingRoutings();
        if (!is_null($outgoingRoutings)) {

            /** @var Collection<array-key, OutgoingRoutingInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $outgoingRoutings
            );
            $this->replaceOutgoingRoutings($replacement);
        }

        $relPatternGroups = $dto->getRelPatternGroups();
        if (!is_null($relPatternGroups)) {

            /** @var Collection<array-key, RoutingPatternGroupsRelPatternInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $relPatternGroups
            );
            $this->replaceRelPatternGroups($replacement);
        }

        $lcrRules = $dto->getLcrRules();
        if (!is_null($lcrRules)) {

            /** @var Collection<array-key, TrunksLcrRuleInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $lcrRules
            );
            $this->replaceLcrRules($replacement);
        }
        $this->sanitizeValues();

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): RoutingPatternDto
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

    public function addOutgoingRouting(OutgoingRoutingInterface $outgoingRouting): RoutingPatternInterface
    {
        $this->outgoingRoutings->add($outgoingRouting);

        return $this;
    }

    public function removeOutgoingRouting(OutgoingRoutingInterface $outgoingRouting): RoutingPatternInterface
    {
        $this->outgoingRoutings->removeElement($outgoingRouting);

        return $this;
    }

    /**
     * @param Collection<array-key, OutgoingRoutingInterface> $outgoingRoutings
     */
    public function replaceOutgoingRoutings(Collection $outgoingRoutings): RoutingPatternInterface
    {
        foreach ($outgoingRoutings as $entity) {
            $entity->setRoutingPattern($this);
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

    public function addRelPatternGroup(RoutingPatternGroupsRelPatternInterface $relPatternGroup): RoutingPatternInterface
    {
        $this->relPatternGroups->add($relPatternGroup);

        return $this;
    }

    public function removeRelPatternGroup(RoutingPatternGroupsRelPatternInterface $relPatternGroup): RoutingPatternInterface
    {
        $this->relPatternGroups->removeElement($relPatternGroup);

        return $this;
    }

    /**
     * @param Collection<array-key, RoutingPatternGroupsRelPatternInterface> $relPatternGroups
     */
    public function replaceRelPatternGroups(Collection $relPatternGroups): RoutingPatternInterface
    {
        foreach ($relPatternGroups as $entity) {
            $entity->setRoutingPattern($this);
        }

        $toStringCallable = fn(mixed $val): \Stringable|string => $val instanceof \Stringable ? $val : serialize($val);
        foreach ($this->relPatternGroups as $key => $entity) {
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
            foreach ($relPatternGroups as $newKey => $newEntity) {
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
                    unset($relPatternGroups[$newKey]);
                    $match = true;
                    break;
                }
            }

            if (!$match) {
                $this->relPatternGroups->remove($key);
            }
        }

        foreach ($relPatternGroups as $entity) {
            $this->addRelPatternGroup($entity);
        }

        return $this;
    }

    /**
     * @return array<array-key, RoutingPatternGroupsRelPatternInterface>
     */
    public function getRelPatternGroups(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->relPatternGroups->matching($criteria)->toArray();
        }

        return $this->relPatternGroups->toArray();
    }

    public function addLcrRule(TrunksLcrRuleInterface $lcrRule): RoutingPatternInterface
    {
        $this->lcrRules->add($lcrRule);

        return $this;
    }

    public function removeLcrRule(TrunksLcrRuleInterface $lcrRule): RoutingPatternInterface
    {
        $this->lcrRules->removeElement($lcrRule);

        return $this;
    }

    /**
     * @param Collection<array-key, TrunksLcrRuleInterface> $lcrRules
     */
    public function replaceLcrRules(Collection $lcrRules): RoutingPatternInterface
    {
        foreach ($lcrRules as $entity) {
            $entity->setRoutingPattern($this);
        }

        $toStringCallable = fn(mixed $val): \Stringable|string => $val instanceof \Stringable ? $val : serialize($val);
        foreach ($this->lcrRules as $key => $entity) {
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
            foreach ($lcrRules as $newKey => $newEntity) {
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
                    unset($lcrRules[$newKey]);
                    $match = true;
                    break;
                }
            }

            if (!$match) {
                $this->lcrRules->remove($key);
            }
        }

        foreach ($lcrRules as $entity) {
            $this->addLcrRule($entity);
        }

        return $this;
    }

    /**
     * @return array<array-key, TrunksLcrRuleInterface>
     */
    public function getLcrRules(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->lcrRules->matching($criteria)->toArray();
        }

        return $this->lcrRules->toArray();
    }
}
