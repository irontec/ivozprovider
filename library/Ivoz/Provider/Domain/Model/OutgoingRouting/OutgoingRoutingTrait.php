<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\OutgoingRouting;

use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\ForeignKeyTransformerInterface;
use Ivoz\Cgr\Domain\Model\TpLcrRule\TpLcrRuleInterface;
use Ivoz\Kam\Domain\Model\TrunksLcrRule\TrunksLcrRuleInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Selectable;
use Doctrine\Common\Collections\Criteria;
use Ivoz\Kam\Domain\Model\TrunksLcrRuleTarget\TrunksLcrRuleTargetInterface;
use Ivoz\Provider\Domain\Model\OutgoingRoutingRelCarrier\OutgoingRoutingRelCarrierInterface;

/**
* @codeCoverageIgnore
*/
trait OutgoingRoutingTrait
{
    /**
     * @var ?int
     */
    protected $id = null;

    /**
     * @var TpLcrRuleInterface
     * mappedBy outgoingRouting
     */
    protected $tpLcrRule;

    /**
     * @var Collection<array-key, TrunksLcrRuleInterface> & Selectable<array-key, TrunksLcrRuleInterface>
     * TrunksLcrRuleInterface mappedBy outgoingRouting
     */
    protected $lcrRules;

    /**
     * @var Collection<array-key, TrunksLcrRuleTargetInterface> & Selectable<array-key, TrunksLcrRuleTargetInterface>
     * TrunksLcrRuleTargetInterface mappedBy outgoingRouting
     */
    protected $lcrRuleTargets;

    /**
     * @var Collection<array-key, OutgoingRoutingRelCarrierInterface> & Selectable<array-key, OutgoingRoutingRelCarrierInterface>
     * OutgoingRoutingRelCarrierInterface mappedBy outgoingRouting
     * orphanRemoval
     */
    protected $relCarriers;

    /**
     * Constructor
     */
    protected function __construct()
    {
        parent::__construct(...func_get_args());
        $this->lcrRules = new ArrayCollection();
        $this->lcrRuleTargets = new ArrayCollection();
        $this->relCarriers = new ArrayCollection();
    }

    abstract protected function sanitizeValues(): void;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param OutgoingRoutingDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        /** @var static $self */
        $self = parent::fromDto($dto, $fkTransformer);
        if (!is_null($dto->getTpLcrRule())) {
            /** @var TpLcrRuleInterface $entity */
            $entity = $fkTransformer->transform(
                $dto->getTpLcrRule()
            );
            $self->setTpLcrRule($entity);
        }

        $lcrRules = $dto->getLcrRules();
        if (!is_null($lcrRules)) {

            /** @var Collection<array-key, TrunksLcrRuleInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $lcrRules
            );
            $self->replaceLcrRules($replacement);
        }

        $lcrRuleTargets = $dto->getLcrRuleTargets();
        if (!is_null($lcrRuleTargets)) {

            /** @var Collection<array-key, TrunksLcrRuleTargetInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $lcrRuleTargets
            );
            $self->replaceLcrRuleTargets($replacement);
        }

        $relCarriers = $dto->getRelCarriers();
        if (!is_null($relCarriers)) {

            /** @var Collection<array-key, OutgoingRoutingRelCarrierInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $relCarriers
            );
            $self->replaceRelCarriers($replacement);
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
     * @param OutgoingRoutingDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        parent::updateFromDto($dto, $fkTransformer);
        if (!is_null($dto->getTpLcrRule())) {
            /** @var TpLcrRuleInterface $entity */
            $entity = $fkTransformer->transform(
                $dto->getTpLcrRule()
            );
            $this->setTpLcrRule($entity);
        }

        $lcrRules = $dto->getLcrRules();
        if (!is_null($lcrRules)) {

            /** @var Collection<array-key, TrunksLcrRuleInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $lcrRules
            );
            $this->replaceLcrRules($replacement);
        }

        $lcrRuleTargets = $dto->getLcrRuleTargets();
        if (!is_null($lcrRuleTargets)) {

            /** @var Collection<array-key, TrunksLcrRuleTargetInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $lcrRuleTargets
            );
            $this->replaceLcrRuleTargets($replacement);
        }

        $relCarriers = $dto->getRelCarriers();
        if (!is_null($relCarriers)) {

            /** @var Collection<array-key, OutgoingRoutingRelCarrierInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $relCarriers
            );
            $this->replaceRelCarriers($replacement);
        }
        $this->sanitizeValues();

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): OutgoingRoutingDto
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

    public function setTpLcrRule(TpLcrRuleInterface $tpLcrRule): static
    {
        $this->tpLcrRule = $tpLcrRule;

        return $this;
    }

    public function getTpLcrRule(): ?TpLcrRuleInterface
    {
        return $this->tpLcrRule;
    }

    public function addLcrRule(TrunksLcrRuleInterface $lcrRule): OutgoingRoutingInterface
    {
        $this->lcrRules->add($lcrRule);

        return $this;
    }

    public function removeLcrRule(TrunksLcrRuleInterface $lcrRule): OutgoingRoutingInterface
    {
        $this->lcrRules->removeElement($lcrRule);

        return $this;
    }

    /**
     * @param Collection<array-key, TrunksLcrRuleInterface> $lcrRules
     */
    public function replaceLcrRules(Collection $lcrRules): OutgoingRoutingInterface
    {
        foreach ($lcrRules as $entity) {
            $entity->setOutgoingRouting($this);
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

    public function addLcrRuleTarget(TrunksLcrRuleTargetInterface $lcrRuleTarget): OutgoingRoutingInterface
    {
        $this->lcrRuleTargets->add($lcrRuleTarget);

        return $this;
    }

    public function removeLcrRuleTarget(TrunksLcrRuleTargetInterface $lcrRuleTarget): OutgoingRoutingInterface
    {
        $this->lcrRuleTargets->removeElement($lcrRuleTarget);

        return $this;
    }

    /**
     * @param Collection<array-key, TrunksLcrRuleTargetInterface> $lcrRuleTargets
     */
    public function replaceLcrRuleTargets(Collection $lcrRuleTargets): OutgoingRoutingInterface
    {
        foreach ($lcrRuleTargets as $entity) {
            $entity->setOutgoingRouting($this);
        }

        $toStringCallable = fn(mixed $val): \Stringable|string => $val instanceof \Stringable ? $val : serialize($val);
        foreach ($this->lcrRuleTargets as $key => $entity) {
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
            foreach ($lcrRuleTargets as $newKey => $newEntity) {
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
                    unset($lcrRuleTargets[$newKey]);
                    $match = true;
                    break;
                }
            }

            if (!$match) {
                $this->lcrRuleTargets->remove($key);
            }
        }

        foreach ($lcrRuleTargets as $entity) {
            $this->addLcrRuleTarget($entity);
        }

        return $this;
    }

    /**
     * @return array<array-key, TrunksLcrRuleTargetInterface>
     */
    public function getLcrRuleTargets(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->lcrRuleTargets->matching($criteria)->toArray();
        }

        return $this->lcrRuleTargets->toArray();
    }

    public function addRelCarrier(OutgoingRoutingRelCarrierInterface $relCarrier): OutgoingRoutingInterface
    {
        $this->relCarriers->add($relCarrier);

        return $this;
    }

    public function removeRelCarrier(OutgoingRoutingRelCarrierInterface $relCarrier): OutgoingRoutingInterface
    {
        $this->relCarriers->removeElement($relCarrier);

        return $this;
    }

    /**
     * @param Collection<array-key, OutgoingRoutingRelCarrierInterface> $relCarriers
     */
    public function replaceRelCarriers(Collection $relCarriers): OutgoingRoutingInterface
    {
        foreach ($relCarriers as $entity) {
            $entity->setOutgoingRouting($this);
        }

        $toStringCallable = fn(mixed $val): \Stringable|string => $val instanceof \Stringable ? $val : serialize($val);
        foreach ($this->relCarriers as $key => $entity) {
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
            foreach ($relCarriers as $newKey => $newEntity) {
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
                    unset($relCarriers[$newKey]);
                    $match = true;
                    break;
                }
            }

            if (!$match) {
                $this->relCarriers->remove($key);
            }
        }

        foreach ($relCarriers as $entity) {
            $this->addRelCarrier($entity);
        }

        return $this;
    }

    /**
     * @return array<array-key, OutgoingRoutingRelCarrierInterface>
     */
    public function getRelCarriers(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->relCarriers->matching($criteria)->toArray();
        }

        return $this->relCarriers->toArray();
    }
}
