<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\Carrier;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Selectable;
use Doctrine\Common\Collections\Criteria;
use Ivoz\Provider\Domain\Model\OutgoingRoutingRelCarrier\OutgoingRoutingRelCarrierInterface;
use Ivoz\Provider\Domain\Model\CarrierServer\CarrierServerInterface;
use Ivoz\Provider\Domain\Model\RatingProfile\RatingProfileInterface;
use Ivoz\Cgr\Domain\Model\TpCdrStat\TpCdrStatInterface;

/**
* @codeCoverageIgnore
*/
trait CarrierTrait
{
    /**
     * @var ?int
     */
    protected $id = null;

    /**
     * @var Collection<array-key, OutgoingRoutingInterface> & Selectable<array-key, OutgoingRoutingInterface>
     * OutgoingRoutingInterface mappedBy carrier
     */
    protected $outgoingRoutings;

    /**
     * @var Collection<array-key, OutgoingRoutingRelCarrierInterface> & Selectable<array-key, OutgoingRoutingRelCarrierInterface>
     * OutgoingRoutingRelCarrierInterface mappedBy carrier
     */
    protected $outgoingRoutingsRelCarriers;

    /**
     * @var Collection<array-key, CarrierServerInterface> & Selectable<array-key, CarrierServerInterface>
     * CarrierServerInterface mappedBy carrier
     */
    protected $servers;

    /**
     * @var Collection<array-key, RatingProfileInterface> & Selectable<array-key, RatingProfileInterface>
     * RatingProfileInterface mappedBy carrier
     */
    protected $ratingProfiles;

    /**
     * @var Collection<array-key, TpCdrStatInterface> & Selectable<array-key, TpCdrStatInterface>
     * TpCdrStatInterface mappedBy carrier
     */
    protected $tpCdrStats;

    /**
     * Constructor
     */
    protected function __construct()
    {
        parent::__construct(...func_get_args());
        $this->outgoingRoutings = new ArrayCollection();
        $this->outgoingRoutingsRelCarriers = new ArrayCollection();
        $this->servers = new ArrayCollection();
        $this->ratingProfiles = new ArrayCollection();
        $this->tpCdrStats = new ArrayCollection();
    }

    abstract protected function sanitizeValues(): void;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param CarrierDto $dto
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

        $outgoingRoutingsRelCarriers = $dto->getOutgoingRoutingsRelCarriers();
        if (!is_null($outgoingRoutingsRelCarriers)) {

            /** @var Collection<array-key, OutgoingRoutingRelCarrierInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $outgoingRoutingsRelCarriers
            );
            $self->replaceOutgoingRoutingsRelCarriers($replacement);
        }

        $servers = $dto->getServers();
        if (!is_null($servers)) {

            /** @var Collection<array-key, CarrierServerInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $servers
            );
            $self->replaceServers($replacement);
        }

        $ratingProfiles = $dto->getRatingProfiles();
        if (!is_null($ratingProfiles)) {

            /** @var Collection<array-key, RatingProfileInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $ratingProfiles
            );
            $self->replaceRatingProfiles($replacement);
        }

        $tpCdrStats = $dto->getTpCdrStats();
        if (!is_null($tpCdrStats)) {

            /** @var Collection<array-key, TpCdrStatInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $tpCdrStats
            );
            $self->replaceTpCdrStats($replacement);
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
     * @param CarrierDto $dto
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

        $outgoingRoutingsRelCarriers = $dto->getOutgoingRoutingsRelCarriers();
        if (!is_null($outgoingRoutingsRelCarriers)) {

            /** @var Collection<array-key, OutgoingRoutingRelCarrierInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $outgoingRoutingsRelCarriers
            );
            $this->replaceOutgoingRoutingsRelCarriers($replacement);
        }

        $servers = $dto->getServers();
        if (!is_null($servers)) {

            /** @var Collection<array-key, CarrierServerInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $servers
            );
            $this->replaceServers($replacement);
        }

        $ratingProfiles = $dto->getRatingProfiles();
        if (!is_null($ratingProfiles)) {

            /** @var Collection<array-key, RatingProfileInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $ratingProfiles
            );
            $this->replaceRatingProfiles($replacement);
        }

        $tpCdrStats = $dto->getTpCdrStats();
        if (!is_null($tpCdrStats)) {

            /** @var Collection<array-key, TpCdrStatInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $tpCdrStats
            );
            $this->replaceTpCdrStats($replacement);
        }
        $this->sanitizeValues();

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): CarrierDto
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

    public function addOutgoingRouting(OutgoingRoutingInterface $outgoingRouting): CarrierInterface
    {
        $this->outgoingRoutings->add($outgoingRouting);

        return $this;
    }

    public function removeOutgoingRouting(OutgoingRoutingInterface $outgoingRouting): CarrierInterface
    {
        $this->outgoingRoutings->removeElement($outgoingRouting);

        return $this;
    }

    /**
     * @param Collection<array-key, OutgoingRoutingInterface> $outgoingRoutings
     */
    public function replaceOutgoingRoutings(Collection $outgoingRoutings): CarrierInterface
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($outgoingRoutings as $entity) {
            /** @var string|int $index */
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setCarrier($this);
        }

        foreach ($this->outgoingRoutings as $key => $entity) {
            $identity = $entity->getId();
            if (!$identity) {
                $this->outgoingRoutings->remove($key);
                continue;
            }

            if (array_key_exists($identity, $updatedEntities)) {
                $this->outgoingRoutings->set($key, $updatedEntities[$identity]);
                unset($updatedEntities[$identity]);
            } else {
                $this->outgoingRoutings->remove($key);
            }
        }

        foreach ($updatedEntities as $entity) {
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

    public function addOutgoingRoutingsRelCarrier(OutgoingRoutingRelCarrierInterface $outgoingRoutingsRelCarrier): CarrierInterface
    {
        $this->outgoingRoutingsRelCarriers->add($outgoingRoutingsRelCarrier);

        return $this;
    }

    public function removeOutgoingRoutingsRelCarrier(OutgoingRoutingRelCarrierInterface $outgoingRoutingsRelCarrier): CarrierInterface
    {
        $this->outgoingRoutingsRelCarriers->removeElement($outgoingRoutingsRelCarrier);

        return $this;
    }

    /**
     * @param Collection<array-key, OutgoingRoutingRelCarrierInterface> $outgoingRoutingsRelCarriers
     */
    public function replaceOutgoingRoutingsRelCarriers(Collection $outgoingRoutingsRelCarriers): CarrierInterface
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($outgoingRoutingsRelCarriers as $entity) {
            /** @var string|int $index */
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setCarrier($this);
        }

        foreach ($this->outgoingRoutingsRelCarriers as $key => $entity) {
            $identity = $entity->getId();
            if (!$identity) {
                $this->outgoingRoutingsRelCarriers->remove($key);
                continue;
            }

            if (array_key_exists($identity, $updatedEntities)) {
                $this->outgoingRoutingsRelCarriers->set($key, $updatedEntities[$identity]);
                unset($updatedEntities[$identity]);
            } else {
                $this->outgoingRoutingsRelCarriers->remove($key);
            }
        }

        foreach ($updatedEntities as $entity) {
            $this->addOutgoingRoutingsRelCarrier($entity);
        }

        return $this;
    }

    /**
     * @return array<array-key, OutgoingRoutingRelCarrierInterface>
     */
    public function getOutgoingRoutingsRelCarriers(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->outgoingRoutingsRelCarriers->matching($criteria)->toArray();
        }

        return $this->outgoingRoutingsRelCarriers->toArray();
    }

    public function addServer(CarrierServerInterface $server): CarrierInterface
    {
        $this->servers->add($server);

        return $this;
    }

    public function removeServer(CarrierServerInterface $server): CarrierInterface
    {
        $this->servers->removeElement($server);

        return $this;
    }

    /**
     * @param Collection<array-key, CarrierServerInterface> $servers
     */
    public function replaceServers(Collection $servers): CarrierInterface
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($servers as $entity) {
            /** @var string|int $index */
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setCarrier($this);
        }

        foreach ($this->servers as $key => $entity) {
            $identity = $entity->getId();
            if (!$identity) {
                $this->servers->remove($key);
                continue;
            }

            if (array_key_exists($identity, $updatedEntities)) {
                $this->servers->set($key, $updatedEntities[$identity]);
                unset($updatedEntities[$identity]);
            } else {
                $this->servers->remove($key);
            }
        }

        foreach ($updatedEntities as $entity) {
            $this->addServer($entity);
        }

        return $this;
    }

    /**
     * @return array<array-key, CarrierServerInterface>
     */
    public function getServers(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->servers->matching($criteria)->toArray();
        }

        return $this->servers->toArray();
    }

    public function addRatingProfile(RatingProfileInterface $ratingProfile): CarrierInterface
    {
        $this->ratingProfiles->add($ratingProfile);

        return $this;
    }

    public function removeRatingProfile(RatingProfileInterface $ratingProfile): CarrierInterface
    {
        $this->ratingProfiles->removeElement($ratingProfile);

        return $this;
    }

    /**
     * @param Collection<array-key, RatingProfileInterface> $ratingProfiles
     */
    public function replaceRatingProfiles(Collection $ratingProfiles): CarrierInterface
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($ratingProfiles as $entity) {
            /** @var string|int $index */
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setCarrier($this);
        }

        foreach ($this->ratingProfiles as $key => $entity) {
            $identity = $entity->getId();
            if (!$identity) {
                $this->ratingProfiles->remove($key);
                continue;
            }

            if (array_key_exists($identity, $updatedEntities)) {
                $this->ratingProfiles->set($key, $updatedEntities[$identity]);
                unset($updatedEntities[$identity]);
            } else {
                $this->ratingProfiles->remove($key);
            }
        }

        foreach ($updatedEntities as $entity) {
            $this->addRatingProfile($entity);
        }

        return $this;
    }

    /**
     * @return array<array-key, RatingProfileInterface>
     */
    public function getRatingProfiles(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->ratingProfiles->matching($criteria)->toArray();
        }

        return $this->ratingProfiles->toArray();
    }

    public function addTpCdrStat(TpCdrStatInterface $tpCdrStat): CarrierInterface
    {
        $this->tpCdrStats->add($tpCdrStat);

        return $this;
    }

    public function removeTpCdrStat(TpCdrStatInterface $tpCdrStat): CarrierInterface
    {
        $this->tpCdrStats->removeElement($tpCdrStat);

        return $this;
    }

    /**
     * @param Collection<array-key, TpCdrStatInterface> $tpCdrStats
     */
    public function replaceTpCdrStats(Collection $tpCdrStats): CarrierInterface
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($tpCdrStats as $entity) {
            /** @var string|int $index */
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setCarrier($this);
        }

        foreach ($this->tpCdrStats as $key => $entity) {
            $identity = $entity->getId();
            if (!$identity) {
                $this->tpCdrStats->remove($key);
                continue;
            }

            if (array_key_exists($identity, $updatedEntities)) {
                $this->tpCdrStats->set($key, $updatedEntities[$identity]);
                unset($updatedEntities[$identity]);
            } else {
                $this->tpCdrStats->remove($key);
            }
        }

        foreach ($updatedEntities as $entity) {
            $this->addTpCdrStat($entity);
        }

        return $this;
    }

    /**
     * @return array<array-key, TpCdrStatInterface>
     */
    public function getTpCdrStats(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->tpCdrStats->matching($criteria)->toArray();
        }

        return $this->tpCdrStats->toArray();
    }
}
