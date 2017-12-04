<?php

namespace Ivoz\Provider\Domain\Model\PeeringContract;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;

/**
 * PeeringContractTrait
 * @codeCoverageIgnore
 */
trait PeeringContractTrait
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var Collection
     */
    protected $outgoingRoutings;

    /**
     * @var Collection
     */
    protected $peerServers;


    /**
     * Constructor
     */
    protected function __construct()
    {
        parent::__construct(...func_get_args());
        $this->outgoingRoutings = new ArrayCollection();
        $this->peerServers = new ArrayCollection();
    }

    /**
     * @return PeeringContractDTO
     */
    public static function createDTO()
    {
        return new PeeringContractDTO();
    }

    /**
     * Factory method
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto PeeringContractDTO
         */
        $self = parent::fromDTO($dto);
        if ($dto->getOutgoingRoutings()) {
            $self->replaceOutgoingRoutings($dto->getOutgoingRoutings());
        }

        if ($dto->getPeerServers()) {
            $self->replacePeerServers($dto->getPeerServers());
        }
        if ($dto->getId()) {
            $self->id = $dto->getId();
            $self->initChangelog();
        }

        return $self;
    }

    /**
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public function updateFromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto PeeringContractDTO
         */
        parent::updateFromDTO($dto);
        if ($dto->getOutgoingRoutings()) {
            $this->replaceOutgoingRoutings($dto->getOutgoingRoutings());
        }
        if ($dto->getPeerServers()) {
            $this->replacePeerServers($dto->getPeerServers());
        }
        return $this;
    }

    /**
     * @return PeeringContractDTO
     */
    public function toDTO()
    {
        $dto = parent::toDTO();
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
     * @return PeeringContractTrait
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
     * @param \Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface[] $outgoingRoutings
     * @return self
     */
    public function replaceOutgoingRoutings(Collection $outgoingRoutings)
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($outgoingRoutings as $entity) {
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setPeeringContract($this);
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
     *
     * @return array
     */
    public function getOutgoingRoutings(Criteria $criteria = null)
    {
        if (!is_null($criteria)) {
            return $this->outgoingRoutings->matching($criteria)->toArray();
        }

        return $this->outgoingRoutings->toArray();
    }

    /**
     * Add peerServer
     *
     * @param \Ivoz\Provider\Domain\Model\PeerServer\PeerServerInterface $peerServer
     *
     * @return PeeringContractTrait
     */
    public function addPeerServer(\Ivoz\Provider\Domain\Model\PeerServer\PeerServerInterface $peerServer)
    {
        $this->peerServers->add($peerServer);

        return $this;
    }

    /**
     * Remove peerServer
     *
     * @param \Ivoz\Provider\Domain\Model\PeerServer\PeerServerInterface $peerServer
     */
    public function removePeerServer(\Ivoz\Provider\Domain\Model\PeerServer\PeerServerInterface $peerServer)
    {
        $this->peerServers->removeElement($peerServer);
    }

    /**
     * Replace peerServers
     *
     * @param \Ivoz\Provider\Domain\Model\PeerServer\PeerServerInterface[] $peerServers
     * @return self
     */
    public function replacePeerServers(Collection $peerServers)
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($peerServers as $entity) {
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setPeeringContract($this);
        }
        $updatedEntityKeys = array_keys($updatedEntities);

        foreach ($this->peerServers as $key => $entity) {
            $identity = $entity->getId();
            if (in_array($identity, $updatedEntityKeys)) {
                $this->peerServers->set($key, $updatedEntities[$identity]);
            } else {
                $this->peerServers->remove($key);
            }
            unset($updatedEntities[$identity]);
        }

        foreach ($updatedEntities as $entity) {
            $this->addPeerServer($entity);
        }

        return $this;
    }

    /**
     * Get peerServers
     *
     * @return array
     */
    public function getPeerServers(Criteria $criteria = null)
    {
        if (!is_null($criteria)) {
            return $this->peerServers->matching($criteria)->toArray();
        }

        return $this->peerServers->toArray();
    }


}

