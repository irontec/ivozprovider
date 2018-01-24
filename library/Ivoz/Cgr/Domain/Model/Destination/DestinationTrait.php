<?php

namespace Ivoz\Cgr\Domain\Model\Destination;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;

/**
 * DestinationTrait
 * @codeCoverageIgnore
 */
trait DestinationTrait
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var Collection
     */
    protected $tpDestination;


    /**
     * Constructor
     */
    protected function __construct()
    {
        parent::__construct(...func_get_args());
        $this->tpDestination = new ArrayCollection();
    }

    /**
     * Factory method
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDto(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto DestinationDto
         */
        $self = parent::fromDto($dto);
        if ($dto->getTpDestination()) {
            $self->replaceTpDestination($dto->getTpDestination());
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
         * @var $dto DestinationDto
         */
        parent::updateFromDto($dto);
        if ($dto->getTpDestination()) {
            $this->replaceTpDestination($dto->getTpDestination());
        }
        return $this;
    }

    /**
     * @param int $depth
     * @return DestinationDto
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
     * Add tpDestination
     *
     * @param \Ivoz\Cgr\Domain\Model\TpDestination\TpDestinationInterface $tpDestination
     *
     * @return DestinationTrait
     */
    public function addTpDestination(\Ivoz\Cgr\Domain\Model\TpDestination\TpDestinationInterface $tpDestination)
    {
        $this->tpDestination->add($tpDestination);

        return $this;
    }

    /**
     * Remove tpDestination
     *
     * @param \Ivoz\Cgr\Domain\Model\TpDestination\TpDestinationInterface $tpDestination
     */
    public function removeTpDestination(\Ivoz\Cgr\Domain\Model\TpDestination\TpDestinationInterface $tpDestination)
    {
        $this->tpDestination->removeElement($tpDestination);
    }

    /**
     * Replace tpDestination
     *
     * @param \Ivoz\Cgr\Domain\Model\TpDestination\TpDestinationInterface[] $tpDestination
     * @return self
     */
    public function replaceTpDestination(Collection $tpDestination)
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($tpDestination as $entity) {
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setDestination($this);
        }
        $updatedEntityKeys = array_keys($updatedEntities);

        foreach ($this->tpDestination as $key => $entity) {
            $identity = $entity->getId();
            if (in_array($identity, $updatedEntityKeys)) {
                $this->tpDestination->set($key, $updatedEntities[$identity]);
            } else {
                $this->tpDestination->remove($key);
            }
            unset($updatedEntities[$identity]);
        }

        foreach ($updatedEntities as $entity) {
            $this->addTpDestination($entity);
        }

        return $this;
    }

    /**
     * Get tpDestination
     *
     * @return \Ivoz\Cgr\Domain\Model\TpDestination\TpDestinationInterface[]
     */
    public function getTpDestination(Criteria $criteria = null)
    {
        if (!is_null($criteria)) {
            return $this->tpDestination->matching($criteria)->toArray();
        }

        return $this->tpDestination->toArray();
    }


}

