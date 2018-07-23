<?php

namespace Ivoz\Provider\Domain\Model\Carrier;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     * @var Collection
     */
    protected $outgoingRoutings;

    /**
     * @var Collection
     */
    protected $servers;


    /**
     * Constructor
     */
    protected function __construct()
    {
        parent::__construct(...func_get_args());
        $this->outgoingRoutings = new ArrayCollection();
        $this->servers = new ArrayCollection();
    }

    /**
     * Factory method
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDto(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto CarrierDto
         */
        $self = parent::fromDto($dto);
        if ($dto->getOutgoingRoutings()) {
            $self->replaceOutgoingRoutings($dto->getOutgoingRoutings());
        }

        if ($dto->getServers()) {
            $self->replaceServers($dto->getServers());
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
    public function updateFromDto(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto CarrierDto
         */
        parent::updateFromDto($dto);
        if ($dto->getOutgoingRoutings()) {
            $this->replaceOutgoingRoutings($dto->getOutgoingRoutings());
        }
        if ($dto->getServers()) {
            $this->replaceServers($dto->getServers());
        }
        return $this;
    }

    /**
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
     * @return CarrierTrait
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
     *
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
     * Add server
     *
     * @param \Ivoz\Provider\Domain\Model\CarrierServer\CarrierServerInterface $server
     *
     * @return CarrierTrait
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
     * @param \Ivoz\Provider\Domain\Model\CarrierServer\CarrierServerInterface[] $servers
     * @return self
     */
    public function replaceServers(Collection $servers)
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
     *
     * @return \Ivoz\Provider\Domain\Model\CarrierServer\CarrierServerInterface[]
     */
    public function getServers(Criteria $criteria = null)
    {
        if (!is_null($criteria)) {
            return $this->servers->matching($criteria)->toArray();
        }

        return $this->servers->toArray();
    }


}

