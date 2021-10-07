<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\RoutingPattern;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Ivoz\Provider\Domain\Model\RoutingPatternGroupsRelPattern\RoutingPatternGroupsRelPatternInterface;
use Ivoz\Kam\Domain\Model\TrunksLcrRule\TrunksLcrRuleInterface;

/**
* @codeCoverageIgnore
*/
trait RoutingPatternTrait
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var ArrayCollection
     * OutgoingRoutingInterface mappedBy routingPattern
     */
    protected $outgoingRoutings;

    /**
     * @var ArrayCollection
     * RoutingPatternGroupsRelPatternInterface mappedBy routingPattern
     * orphanRemoval
     */
    protected $relPatternGroups;

    /**
     * @var ArrayCollection
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

    abstract protected function sanitizeValues();

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param RoutingPatternDto $dto
     * @param ForeignKeyTransformerInterface  $fkTransformer
     * @return static
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        /** @var static $self */
        $self = parent::fromDto($dto, $fkTransformer);
        if (!is_null($dto->getOutgoingRoutings())) {
            $self->replaceOutgoingRoutings(
                $fkTransformer->transformCollection(
                    $dto->getOutgoingRoutings()
                )
            );
        }

        if (!is_null($dto->getRelPatternGroups())) {
            $self->replaceRelPatternGroups(
                $fkTransformer->transformCollection(
                    $dto->getRelPatternGroups()
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
     * @param ForeignKeyTransformerInterface  $fkTransformer
     * @return static
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        parent::updateFromDto($dto, $fkTransformer);
        if (!is_null($dto->getOutgoingRoutings())) {
            $this->replaceOutgoingRoutings(
                $fkTransformer->transformCollection(
                    $dto->getOutgoingRoutings()
                )
            );
        }

        if (!is_null($dto->getRelPatternGroups())) {
            $this->replaceRelPatternGroups(
                $fkTransformer->transformCollection(
                    $dto->getRelPatternGroups()
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
        $this->sanitizeValues();

        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return RoutingPatternDto
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

    public function replaceOutgoingRoutings(ArrayCollection $outgoingRoutings): RoutingPatternInterface
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($outgoingRoutings as $entity) {
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setRoutingPattern($this);
        }
        $updatedEntityKeys = array_keys($updatedEntities);

        foreach ($this->outgoingRoutings as $key => $entity) {
            $identity = $entity->getId();
            if (in_array($identity, $updatedEntityKeys)) {
                $this->outgoingRoutings->set($key, $updatedEntities[$identity]);
            } else {
                $this->outgoingRoutings->remove($key);
            }
            unset($updatedEntities[$identity]);
        }

        foreach ($updatedEntities as $entity) {
            $this->addOutgoingRouting($entity);
        }

        return $this;
    }

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

    public function replaceRelPatternGroups(ArrayCollection $relPatternGroups): RoutingPatternInterface
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($relPatternGroups as $entity) {
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setRoutingPattern($this);
        }
        $updatedEntityKeys = array_keys($updatedEntities);

        foreach ($this->relPatternGroups as $key => $entity) {
            $identity = $entity->getId();
            if (in_array($identity, $updatedEntityKeys)) {
                $this->relPatternGroups->set($key, $updatedEntities[$identity]);
            } else {
                $this->relPatternGroups->remove($key);
            }
            unset($updatedEntities[$identity]);
        }

        foreach ($updatedEntities as $entity) {
            $this->addRelPatternGroup($entity);
        }

        return $this;
    }

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

    public function replaceLcrRules(ArrayCollection $lcrRules): RoutingPatternInterface
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($lcrRules as $entity) {
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setRoutingPattern($this);
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

    public function getLcrRules(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->lcrRules->matching($criteria)->toArray();
        }

        return $this->lcrRules->toArray();
    }
}
