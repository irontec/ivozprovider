<?php
declare(strict_types = 1);

namespace Ivoz\Provider\Domain\Model\OutgoingRouting;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Cgr\Domain\Model\TpLcrRule\TpLcrRuleInterface;
use Ivoz\Kam\Domain\Model\TrunksLcrRule\TrunksLcrRuleInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Ivoz\Kam\Domain\Model\TrunksLcrRuleTarget\TrunksLcrRuleTargetInterface;
use Ivoz\Provider\Domain\Model\OutgoingRoutingRelCarrier\OutgoingRoutingRelCarrierInterface;

/**
* @codeCoverageIgnore
*/
trait OutgoingRoutingTrait
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var TpLcrRuleInterface
     * mappedBy outgoingRouting
     */
    protected $tpLcrRule;

    /**
     * @var ArrayCollection
     * TrunksLcrRuleInterface mappedBy outgoingRouting
     */
    protected $lcrRules;

    /**
     * @var ArrayCollection
     * TrunksLcrRuleTargetInterface mappedBy outgoingRouting
     */
    protected $lcrRuleTargets;

    /**
     * @var ArrayCollection
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

    abstract protected function sanitizeValues();

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param OutgoingRoutingDto $dto
     * @param ForeignKeyTransformerInterface  $fkTransformer
     * @return static
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        /** @var static $self */
        $self = parent::fromDto($dto, $fkTransformer);
        if (!is_null($dto->getTpLcrRule())) {
            $self->setTpLcrRule(
                $fkTransformer->transform(
                    $dto->getTpLcrRule()
                )
            );
        }

        if (!is_null($dto->getLcrRules())) {
            $self->replaceLcrRules(
                $fkTransformer->transformCollection(
                    $dto->getLcrRules()
                )
            );
        }

        if (!is_null($dto->getLcrRuleTargets())) {
            $self->replaceLcrRuleTargets(
                $fkTransformer->transformCollection(
                    $dto->getLcrRuleTargets()
                )
            );
        }

        if (!is_null($dto->getRelCarriers())) {
            $self->replaceRelCarriers(
                $fkTransformer->transformCollection(
                    $dto->getRelCarriers()
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
     * @param OutgoingRoutingDto $dto
     * @param ForeignKeyTransformerInterface  $fkTransformer
     * @return static
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        parent::updateFromDto($dto, $fkTransformer);
        if (!is_null($dto->getTpLcrRule())) {
            $this->setTpLcrRule(
                $fkTransformer->transform(
                    $dto->getTpLcrRule()
                )
            );
        }

        if (!is_null($dto->getLcrRules())) {
            $this->replaceLcrRules(
                $fkTransformer->transformCollection(
                    $dto->getLcrRules()
                )
            );
        }

        if (!is_null($dto->getLcrRuleTargets())) {
            $this->replaceLcrRuleTargets(
                $fkTransformer->transformCollection(
                    $dto->getLcrRuleTargets()
                )
            );
        }

        if (!is_null($dto->getRelCarriers())) {
            $this->replaceRelCarriers(
                $fkTransformer->transformCollection(
                    $dto->getRelCarriers()
                )
            );
        }
        $this->sanitizeValues();

        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return OutgoingRoutingDto
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
     * @var TpLcrRuleInterface
     * mappedBy outgoingRouting
     */
    public function setTpLcrRule(TpLcrRuleInterface $tpLcrRule): OutgoingRoutingInterface
    {
        $this->tpLcrRule = $tpLcrRule;

        return $this;
    }

    /**
     * Get tpLcrRule
     * @return TpLcrRuleInterface
     */
    public function getTpLcrRule(): ?TpLcrRuleInterface
    {
        return $this->tpLcrRule;
    }

    /**
     * Add lcrRule
     *
     * @param TrunksLcrRuleInterface $lcrRule
     *
     * @return static
     */
    public function addLcrRule(TrunksLcrRuleInterface $lcrRule): OutgoingRoutingInterface
    {
        $this->lcrRules->add($lcrRule);

        return $this;
    }

    /**
     * Remove lcrRule
     *
     * @param TrunksLcrRuleInterface $lcrRule
     *
     * @return static
     */
    public function removeLcrRule(TrunksLcrRuleInterface $lcrRule): OutgoingRoutingInterface
    {
        $this->lcrRules->removeElement($lcrRule);

        return $this;
    }

    /**
     * Replace lcrRules
     *
     * @param ArrayCollection $lcrRules of TrunksLcrRuleInterface
     *
     * @return static
     */
    public function replaceLcrRules(ArrayCollection $lcrRules): OutgoingRoutingInterface
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($lcrRules as $entity) {
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setOutgoingRouting($this);
        }
        $updatedEntityKeys = array_keys($updatedEntities);

        foreach ($this->lcrRules as $key => $entity) {
            $identity = $entity->getId();
            if (in_array($identity, $updatedEntityKeys)) {
                $this->lcrRules->set($key, $updatedEntities[$identity]);
            } else {
                $this->lcrRules->remove($key);
            }
            unset($updatedEntities[$identity]);
        }

        foreach ($updatedEntities as $entity) {
            $this->addLcrRule($entity);
        }

        return $this;
    }

    /**
     * Get lcrRules
     * @param Criteria | null $criteria
     * @return TrunksLcrRuleInterface[]
     */
    public function getLcrRules(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->lcrRules->matching($criteria)->toArray();
        }

        return $this->lcrRules->toArray();
    }

    /**
     * Add lcrRuleTarget
     *
     * @param TrunksLcrRuleTargetInterface $lcrRuleTarget
     *
     * @return static
     */
    public function addLcrRuleTarget(TrunksLcrRuleTargetInterface $lcrRuleTarget): OutgoingRoutingInterface
    {
        $this->lcrRuleTargets->add($lcrRuleTarget);

        return $this;
    }

    /**
     * Remove lcrRuleTarget
     *
     * @param TrunksLcrRuleTargetInterface $lcrRuleTarget
     *
     * @return static
     */
    public function removeLcrRuleTarget(TrunksLcrRuleTargetInterface $lcrRuleTarget): OutgoingRoutingInterface
    {
        $this->lcrRuleTargets->removeElement($lcrRuleTarget);

        return $this;
    }

    /**
     * Replace lcrRuleTargets
     *
     * @param ArrayCollection $lcrRuleTargets of TrunksLcrRuleTargetInterface
     *
     * @return static
     */
    public function replaceLcrRuleTargets(ArrayCollection $lcrRuleTargets): OutgoingRoutingInterface
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($lcrRuleTargets as $entity) {
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setOutgoingRouting($this);
        }
        $updatedEntityKeys = array_keys($updatedEntities);

        foreach ($this->lcrRuleTargets as $key => $entity) {
            $identity = $entity->getId();
            if (in_array($identity, $updatedEntityKeys)) {
                $this->lcrRuleTargets->set($key, $updatedEntities[$identity]);
            } else {
                $this->lcrRuleTargets->remove($key);
            }
            unset($updatedEntities[$identity]);
        }

        foreach ($updatedEntities as $entity) {
            $this->addLcrRuleTarget($entity);
        }

        return $this;
    }

    /**
     * Get lcrRuleTargets
     * @param Criteria | null $criteria
     * @return TrunksLcrRuleTargetInterface[]
     */
    public function getLcrRuleTargets(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->lcrRuleTargets->matching($criteria)->toArray();
        }

        return $this->lcrRuleTargets->toArray();
    }

    /**
     * Add relCarrier
     *
     * @param OutgoingRoutingRelCarrierInterface $relCarrier
     *
     * @return static
     */
    public function addRelCarrier(OutgoingRoutingRelCarrierInterface $relCarrier): OutgoingRoutingInterface
    {
        $this->relCarriers->add($relCarrier);

        return $this;
    }

    /**
     * Remove relCarrier
     *
     * @param OutgoingRoutingRelCarrierInterface $relCarrier
     *
     * @return static
     */
    public function removeRelCarrier(OutgoingRoutingRelCarrierInterface $relCarrier): OutgoingRoutingInterface
    {
        $this->relCarriers->removeElement($relCarrier);

        return $this;
    }

    /**
     * Replace relCarriers
     *
     * @param ArrayCollection $relCarriers of OutgoingRoutingRelCarrierInterface
     *
     * @return static
     */
    public function replaceRelCarriers(ArrayCollection $relCarriers): OutgoingRoutingInterface
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($relCarriers as $entity) {
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setOutgoingRouting($this);
        }
        $updatedEntityKeys = array_keys($updatedEntities);

        foreach ($this->relCarriers as $key => $entity) {
            $identity = $entity->getId();
            if (in_array($identity, $updatedEntityKeys)) {
                $this->relCarriers->set($key, $updatedEntities[$identity]);
            } else {
                $this->relCarriers->remove($key);
            }
            unset($updatedEntities[$identity]);
        }

        foreach ($updatedEntities as $entity) {
            $this->addRelCarrier($entity);
        }

        return $this;
    }

    /**
     * Get relCarriers
     * @param Criteria | null $criteria
     * @return OutgoingRoutingRelCarrierInterface[]
     */
    public function getRelCarriers(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->relCarriers->matching($criteria)->toArray();
        }

        return $this->relCarriers->toArray();
    }

}
