<?php
declare(strict_types = 1);

namespace Ivoz\Provider\Domain\Model\Carrier;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface;
use Doctrine\Common\Collections\ArrayCollection;
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
     * @var int
     */
    protected $id;

    /**
     * @var ArrayCollection
     * OutgoingRoutingInterface mappedBy carrier
     */
    protected $outgoingRoutings;

    /**
     * @var ArrayCollection
     * OutgoingRoutingRelCarrierInterface mappedBy carrier
     */
    protected $outgoingRoutingsRelCarriers;

    /**
     * @var ArrayCollection
     * CarrierServerInterface mappedBy carrier
     */
    protected $servers;

    /**
     * @var ArrayCollection
     * RatingProfileInterface mappedBy carrier
     */
    protected $ratingProfiles;

    /**
     * @var ArrayCollection
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

    abstract protected function sanitizeValues();

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param CarrierDto $dto
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
     * @param OutgoingRoutingInterface $outgoingRouting
     *
     * @return static
     */
    public function addOutgoingRouting(OutgoingRoutingInterface $outgoingRouting): CarrierInterface
    {
        $this->outgoingRoutings->add($outgoingRouting);

        return $this;
    }

    /**
     * Remove outgoingRouting
     *
     * @param OutgoingRoutingInterface $outgoingRouting
     *
     * @return static
     */
    public function removeOutgoingRouting(OutgoingRoutingInterface $outgoingRouting): CarrierInterface
    {
        $this->outgoingRoutings->removeElement($outgoingRouting);

        return $this;
    }

    /**
     * Replace outgoingRoutings
     *
     * @param ArrayCollection $outgoingRoutings of OutgoingRoutingInterface
     *
     * @return static
     */
    public function replaceOutgoingRoutings(ArrayCollection $outgoingRoutings): CarrierInterface
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
     * @return OutgoingRoutingInterface[]
     */
    public function getOutgoingRoutings(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->outgoingRoutings->matching($criteria)->toArray();
        }

        return $this->outgoingRoutings->toArray();
    }

    /**
     * Add outgoingRoutingsRelCarrier
     *
     * @param OutgoingRoutingRelCarrierInterface $outgoingRoutingsRelCarrier
     *
     * @return static
     */
    public function addOutgoingRoutingsRelCarrier(OutgoingRoutingRelCarrierInterface $outgoingRoutingsRelCarrier): CarrierInterface
    {
        $this->outgoingRoutingsRelCarriers->add($outgoingRoutingsRelCarrier);

        return $this;
    }

    /**
     * Remove outgoingRoutingsRelCarrier
     *
     * @param OutgoingRoutingRelCarrierInterface $outgoingRoutingsRelCarrier
     *
     * @return static
     */
    public function removeOutgoingRoutingsRelCarrier(OutgoingRoutingRelCarrierInterface $outgoingRoutingsRelCarrier): CarrierInterface
    {
        $this->outgoingRoutingsRelCarriers->removeElement($outgoingRoutingsRelCarrier);

        return $this;
    }

    /**
     * Replace outgoingRoutingsRelCarriers
     *
     * @param ArrayCollection $outgoingRoutingsRelCarriers of OutgoingRoutingRelCarrierInterface
     *
     * @return static
     */
    public function replaceOutgoingRoutingsRelCarriers(ArrayCollection $outgoingRoutingsRelCarriers): CarrierInterface
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
     * @return OutgoingRoutingRelCarrierInterface[]
     */
    public function getOutgoingRoutingsRelCarriers(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->outgoingRoutingsRelCarriers->matching($criteria)->toArray();
        }

        return $this->outgoingRoutingsRelCarriers->toArray();
    }

    /**
     * Add server
     *
     * @param CarrierServerInterface $server
     *
     * @return static
     */
    public function addServer(CarrierServerInterface $server): CarrierInterface
    {
        $this->servers->add($server);

        return $this;
    }

    /**
     * Remove server
     *
     * @param CarrierServerInterface $server
     *
     * @return static
     */
    public function removeServer(CarrierServerInterface $server): CarrierInterface
    {
        $this->servers->removeElement($server);

        return $this;
    }

    /**
     * Replace servers
     *
     * @param ArrayCollection $servers of CarrierServerInterface
     *
     * @return static
     */
    public function replaceServers(ArrayCollection $servers): CarrierInterface
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
     * @return CarrierServerInterface[]
     */
    public function getServers(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->servers->matching($criteria)->toArray();
        }

        return $this->servers->toArray();
    }

    /**
     * Add ratingProfile
     *
     * @param RatingProfileInterface $ratingProfile
     *
     * @return static
     */
    public function addRatingProfile(RatingProfileInterface $ratingProfile): CarrierInterface
    {
        $this->ratingProfiles->add($ratingProfile);

        return $this;
    }

    /**
     * Remove ratingProfile
     *
     * @param RatingProfileInterface $ratingProfile
     *
     * @return static
     */
    public function removeRatingProfile(RatingProfileInterface $ratingProfile): CarrierInterface
    {
        $this->ratingProfiles->removeElement($ratingProfile);

        return $this;
    }

    /**
     * Replace ratingProfiles
     *
     * @param ArrayCollection $ratingProfiles of RatingProfileInterface
     *
     * @return static
     */
    public function replaceRatingProfiles(ArrayCollection $ratingProfiles): CarrierInterface
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
     * @return RatingProfileInterface[]
     */
    public function getRatingProfiles(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->ratingProfiles->matching($criteria)->toArray();
        }

        return $this->ratingProfiles->toArray();
    }

    /**
     * Add tpCdrStat
     *
     * @param TpCdrStatInterface $tpCdrStat
     *
     * @return static
     */
    public function addTpCdrStat(TpCdrStatInterface $tpCdrStat): CarrierInterface
    {
        $this->tpCdrStats->add($tpCdrStat);

        return $this;
    }

    /**
     * Remove tpCdrStat
     *
     * @param TpCdrStatInterface $tpCdrStat
     *
     * @return static
     */
    public function removeTpCdrStat(TpCdrStatInterface $tpCdrStat): CarrierInterface
    {
        $this->tpCdrStats->removeElement($tpCdrStat);

        return $this;
    }

    /**
     * Replace tpCdrStats
     *
     * @param ArrayCollection $tpCdrStats of TpCdrStatInterface
     *
     * @return static
     */
    public function replaceTpCdrStats(ArrayCollection $tpCdrStats): CarrierInterface
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
     * @return TpCdrStatInterface[]
     */
    public function getTpCdrStats(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->tpCdrStats->matching($criteria)->toArray();
        }

        return $this->tpCdrStats->toArray();
    }

}
