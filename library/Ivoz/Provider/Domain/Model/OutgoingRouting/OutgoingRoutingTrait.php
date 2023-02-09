<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\OutgoingRouting;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
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
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($lcrRules as $entity) {
            /** @var string|int $index */
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setOutgoingRouting($this);
        }

        foreach ($this->lcrRules as $key => $entity) {
            $identity = $entity->getId();
            if (!$identity) {
                $this->lcrRules->remove($key);
                continue;
            }

            if (array_key_exists($identity, $updatedEntities)) {
                $this->lcrRules->set($key, $updatedEntities[$identity]);
                unset($updatedEntities[$identity]);
            } else {
                $this->lcrRules->remove($key);
            }
        }

        foreach ($updatedEntities as $entity) {
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
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($lcrRuleTargets as $entity) {
            /** @var string|int $index */
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setOutgoingRouting($this);
        }

        foreach ($this->lcrRuleTargets as $key => $entity) {
            $identity = $entity->getId();
            if (!$identity) {
                $this->lcrRuleTargets->remove($key);
                continue;
            }

            if (array_key_exists($identity, $updatedEntities)) {
                $this->lcrRuleTargets->set($key, $updatedEntities[$identity]);
                unset($updatedEntities[$identity]);
            } else {
                $this->lcrRuleTargets->remove($key);
            }
        }

        foreach ($updatedEntities as $entity) {
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
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($relCarriers as $entity) {
            /** @var string|int $index */
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setOutgoingRouting($this);
        }

        foreach ($this->relCarriers as $key => $entity) {
            $identity = $entity->getId();
            if (!$identity) {
                $this->relCarriers->remove($key);
                continue;
            }

            if (array_key_exists($identity, $updatedEntities)) {
                $this->relCarriers->set($key, $updatedEntities[$identity]);
                unset($updatedEntities[$identity]);
            } else {
                $this->relCarriers->remove($key);
            }
        }

        foreach ($updatedEntities as $entity) {
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
