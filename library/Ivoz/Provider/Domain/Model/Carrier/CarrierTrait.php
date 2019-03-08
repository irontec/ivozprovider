<?php

namespace Ivoz\Provider\Domain\Model\Carrier;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;

/**
 * CarrierTrait
 * @codeCoverageIgnore
 */
trait CarrierTrait
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var ArrayCollection
     */
    protected $outgoingRoutings;

    /**
     * @var ArrayCollection
     */
    protected $outgoingRoutingsRelCarriers;

    /**
     * @var ArrayCollection
     */
    protected $servers;

    /**
     * @var ArrayCollection
     */
    protected $ratingProfiles;

    /**
     * @var ArrayCollection
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

    abstract protected function sanitizeValues();

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param CarrierDto $dto
     * @param \Ivoz\Core\Application\ForeignKeyTransformerInterface  $fkTransformer
     * @return static
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
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

        if (!is_null($dto->getOutgoingRoutingsRelCarriers())) {
            $self->replaceOutgoingRoutingsRelCarriers(
                $fkTransformer->transformCollection(
                    $dto->getOutgoingRoutingsRelCarriers()
                )
            );
        }

        if (!is_null($dto->getServers())) {
            $self->replaceServers(
                $fkTransformer->transformCollection(
                    $dto->getServers()
                )
            );
        }

        if (!is_null($dto->getRatingProfiles())) {
            $self->replaceRatingProfiles(
                $fkTransformer->transformCollection(
                    $dto->getRatingProfiles()
                )
            );
        }

        if (!is_null($dto->getTpCdrStats())) {
            $self->replaceTpCdrStats(
                $fkTransformer->transformCollection(
                    $dto->getTpCdrStats()
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
     * @param CarrierDto $dto
     * @param \Ivoz\Core\Application\ForeignKeyTransformerInterface  $fkTransformer
     * @return static
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        parent::updateFromDto($dto, $fkTransformer);
        if (!is_null($dto->getOutgoingRoutings())) {
            $this->replaceOutgoingRoutings(
                $fkTransformer->transformCollection(
                    $dto->getOutgoingRoutings()
                )
            );
        }
        if (!is_null($dto->getOutgoingRoutingsRelCarriers())) {
            $this->replaceOutgoingRoutingsRelCarriers(
                $fkTransformer->transformCollection(
                    $dto->getOutgoingRoutingsRelCarriers()
                )
            );
        }
        if (!is_null($dto->getServers())) {
            $this->replaceServers(
                $fkTransformer->transformCollection(
                    $dto->getServers()
                )
            );
        }
        if (!is_null($dto->getRatingProfiles())) {
            $this->replaceRatingProfiles(
                $fkTransformer->transformCollection(
                    $dto->getRatingProfiles()
                )
            );
        }
        if (!is_null($dto->getTpCdrStats())) {
            $this->replaceTpCdrStats(
                $fkTransformer->transformCollection(
                    $dto->getTpCdrStats()
                )
            );
        }
        $this->sanitizeValues();

        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return CarrierDto
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
     * Add outgoingRouting
     *
     * @param \Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface $outgoingRouting
     *
     * @return static
     */
    public function addOutgoingRouting(\Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface $outgoingRouting)
    {
        $this->outgoingRoutings->add($outgoingRouting);

        return $this;
    }

    /**
     * Remove outgoingRouting
     *
     * @param \Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface $outgoingRouting
     */
    public function removeOutgoingRouting(\Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface $outgoingRouting)
    {
        $this->outgoingRoutings->removeElement($outgoingRouting);
    }

    /**
     * Replace outgoingRoutings
     *
     * @param ArrayCollection $outgoingRoutings of Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface
     * @return static
     */
    public function replaceOutgoingRoutings(ArrayCollection $outgoingRoutings)
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($outgoingRoutings as $entity) {
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setCarrier($this);
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

    /**
     * Get outgoingRoutings
     * @param Criteria | null $criteria
     * @return \Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface[]
     */
    public function getOutgoingRoutings(Criteria $criteria = null)
    {
        if (!is_null($criteria)) {
            return $this->outgoingRoutings->matching($criteria)->toArray();
        }

        return $this->outgoingRoutings->toArray();
    }

    /**
     * Add outgoingRoutingsRelCarrier
     *
     * @param \Ivoz\Provider\Domain\Model\OutgoingRoutingRelCarrier\OutgoingRoutingRelCarrierInterface $outgoingRoutingsRelCarrier
     *
     * @return static
     */
    public function addOutgoingRoutingsRelCarrier(\Ivoz\Provider\Domain\Model\OutgoingRoutingRelCarrier\OutgoingRoutingRelCarrierInterface $outgoingRoutingsRelCarrier)
    {
        $this->outgoingRoutingsRelCarriers->add($outgoingRoutingsRelCarrier);

        return $this;
    }

    /**
     * Remove outgoingRoutingsRelCarrier
     *
     * @param \Ivoz\Provider\Domain\Model\OutgoingRoutingRelCarrier\OutgoingRoutingRelCarrierInterface $outgoingRoutingsRelCarrier
     */
    public function removeOutgoingRoutingsRelCarrier(\Ivoz\Provider\Domain\Model\OutgoingRoutingRelCarrier\OutgoingRoutingRelCarrierInterface $outgoingRoutingsRelCarrier)
    {
        $this->outgoingRoutingsRelCarriers->removeElement($outgoingRoutingsRelCarrier);
    }

    /**
     * Replace outgoingRoutingsRelCarriers
     *
     * @param ArrayCollection $outgoingRoutingsRelCarriers of Ivoz\Provider\Domain\Model\OutgoingRoutingRelCarrier\OutgoingRoutingRelCarrierInterface
     * @return static
     */
    public function replaceOutgoingRoutingsRelCarriers(ArrayCollection $outgoingRoutingsRelCarriers)
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($outgoingRoutingsRelCarriers as $entity) {
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setCarrier($this);
        }
        $updatedEntityKeys = array_keys($updatedEntities);

        foreach ($this->outgoingRoutingsRelCarriers as $key => $entity) {
            $identity = $entity->getId();
            if (in_array($identity, $updatedEntityKeys)) {
                $this->outgoingRoutingsRelCarriers->set($key, $updatedEntities[$identity]);
            } else {
                $this->outgoingRoutingsRelCarriers->remove($key);
            }
            unset($updatedEntities[$identity]);
        }

        foreach ($updatedEntities as $entity) {
            $this->addOutgoingRoutingsRelCarrier($entity);
        }

        return $this;
    }

    /**
     * Get outgoingRoutingsRelCarriers
     * @param Criteria | null $criteria
     * @return \Ivoz\Provider\Domain\Model\OutgoingRoutingRelCarrier\OutgoingRoutingRelCarrierInterface[]
     */
    public function getOutgoingRoutingsRelCarriers(Criteria $criteria = null)
    {
        if (!is_null($criteria)) {
            return $this->outgoingRoutingsRelCarriers->matching($criteria)->toArray();
        }

        return $this->outgoingRoutingsRelCarriers->toArray();
    }

    /**
     * Add server
     *
     * @param \Ivoz\Provider\Domain\Model\CarrierServer\CarrierServerInterface $server
     *
     * @return static
     */
    public function addServer(\Ivoz\Provider\Domain\Model\CarrierServer\CarrierServerInterface $server)
    {
        $this->servers->add($server);

        return $this;
    }

    /**
     * Remove server
     *
     * @param \Ivoz\Provider\Domain\Model\CarrierServer\CarrierServerInterface $server
     */
    public function removeServer(\Ivoz\Provider\Domain\Model\CarrierServer\CarrierServerInterface $server)
    {
        $this->servers->removeElement($server);
    }

    /**
     * Replace servers
     *
     * @param ArrayCollection $servers of Ivoz\Provider\Domain\Model\CarrierServer\CarrierServerInterface
     * @return static
     */
    public function replaceServers(ArrayCollection $servers)
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($servers as $entity) {
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setCarrier($this);
        }
        $updatedEntityKeys = array_keys($updatedEntities);

        foreach ($this->servers as $key => $entity) {
            $identity = $entity->getId();
            if (in_array($identity, $updatedEntityKeys)) {
                $this->servers->set($key, $updatedEntities[$identity]);
            } else {
                $this->servers->remove($key);
            }
            unset($updatedEntities[$identity]);
        }

        foreach ($updatedEntities as $entity) {
            $this->addServer($entity);
        }

        return $this;
    }

    /**
     * Get servers
     * @param Criteria | null $criteria
     * @return \Ivoz\Provider\Domain\Model\CarrierServer\CarrierServerInterface[]
     */
    public function getServers(Criteria $criteria = null)
    {
        if (!is_null($criteria)) {
            return $this->servers->matching($criteria)->toArray();
        }

        return $this->servers->toArray();
    }

    /**
     * Add ratingProfile
     *
     * @param \Ivoz\Provider\Domain\Model\RatingProfile\RatingProfileInterface $ratingProfile
     *
     * @return static
     */
    public function addRatingProfile(\Ivoz\Provider\Domain\Model\RatingProfile\RatingProfileInterface $ratingProfile)
    {
        $this->ratingProfiles->add($ratingProfile);

        return $this;
    }

    /**
     * Remove ratingProfile
     *
     * @param \Ivoz\Provider\Domain\Model\RatingProfile\RatingProfileInterface $ratingProfile
     */
    public function removeRatingProfile(\Ivoz\Provider\Domain\Model\RatingProfile\RatingProfileInterface $ratingProfile)
    {
        $this->ratingProfiles->removeElement($ratingProfile);
    }

    /**
     * Replace ratingProfiles
     *
     * @param ArrayCollection $ratingProfiles of Ivoz\Provider\Domain\Model\RatingProfile\RatingProfileInterface
     * @return static
     */
    public function replaceRatingProfiles(ArrayCollection $ratingProfiles)
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($ratingProfiles as $entity) {
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setCarrier($this);
        }
        $updatedEntityKeys = array_keys($updatedEntities);

        foreach ($this->ratingProfiles as $key => $entity) {
            $identity = $entity->getId();
            if (in_array($identity, $updatedEntityKeys)) {
                $this->ratingProfiles->set($key, $updatedEntities[$identity]);
            } else {
                $this->ratingProfiles->remove($key);
            }
            unset($updatedEntities[$identity]);
        }

        foreach ($updatedEntities as $entity) {
            $this->addRatingProfile($entity);
        }

        return $this;
    }

    /**
     * Get ratingProfiles
     * @param Criteria | null $criteria
     * @return \Ivoz\Provider\Domain\Model\RatingProfile\RatingProfileInterface[]
     */
    public function getRatingProfiles(Criteria $criteria = null)
    {
        if (!is_null($criteria)) {
            return $this->ratingProfiles->matching($criteria)->toArray();
        }

        return $this->ratingProfiles->toArray();
    }

    /**
     * Add tpCdrStat
     *
     * @param \Ivoz\Cgr\Domain\Model\TpCdrStat\TpCdrStatInterface $tpCdrStat
     *
     * @return static
     */
    public function addTpCdrStat(\Ivoz\Cgr\Domain\Model\TpCdrStat\TpCdrStatInterface $tpCdrStat)
    {
        $this->tpCdrStats->add($tpCdrStat);

        return $this;
    }

    /**
     * Remove tpCdrStat
     *
     * @param \Ivoz\Cgr\Domain\Model\TpCdrStat\TpCdrStatInterface $tpCdrStat
     */
    public function removeTpCdrStat(\Ivoz\Cgr\Domain\Model\TpCdrStat\TpCdrStatInterface $tpCdrStat)
    {
        $this->tpCdrStats->removeElement($tpCdrStat);
    }

    /**
     * Replace tpCdrStats
     *
     * @param ArrayCollection $tpCdrStats of Ivoz\Cgr\Domain\Model\TpCdrStat\TpCdrStatInterface
     * @return static
     */
    public function replaceTpCdrStats(ArrayCollection $tpCdrStats)
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($tpCdrStats as $entity) {
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setCarrier($this);
        }
        $updatedEntityKeys = array_keys($updatedEntities);

        foreach ($this->tpCdrStats as $key => $entity) {
            $identity = $entity->getId();
            if (in_array($identity, $updatedEntityKeys)) {
                $this->tpCdrStats->set($key, $updatedEntities[$identity]);
            } else {
                $this->tpCdrStats->remove($key);
            }
            unset($updatedEntities[$identity]);
        }

        foreach ($updatedEntities as $entity) {
            $this->addTpCdrStat($entity);
        }

        return $this;
    }

    /**
     * Get tpCdrStats
     * @param Criteria | null $criteria
     * @return \Ivoz\Cgr\Domain\Model\TpCdrStat\TpCdrStatInterface[]
     */
    public function getTpCdrStats(Criteria $criteria = null)
    {
        if (!is_null($criteria)) {
            return $this->tpCdrStats->matching($criteria)->toArray();
        }

        return $this->tpCdrStats->toArray();
    }
}
