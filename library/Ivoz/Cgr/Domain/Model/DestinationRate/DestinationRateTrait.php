<?php

namespace Ivoz\Cgr\Domain\Model\DestinationRate;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;

/**
 * DestinationRateTrait
 * @codeCoverageIgnore
 */
trait DestinationRateTrait
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var Collection
     */
    protected $tpDestinationRates;


    /**
     * Constructor
     */
    protected function __construct()
    {
        parent::__construct(...func_get_args());
        $this->tpDestinationRates = new ArrayCollection();
    }

    /**
     * Factory method
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDto(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto DestinationRateDto
         */
        $self = parent::fromDto($dto);
        if ($dto->getTpDestinationRates()) {
            $self->replaceTpDestinationRates($dto->getTpDestinationRates());
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
         * @var $dto DestinationRateDto
         */
        parent::updateFromDto($dto);
        if ($dto->getTpDestinationRates()) {
            $this->replaceTpDestinationRates($dto->getTpDestinationRates());
        }
        return $this;
    }

    /**
     * @param int $depth
     * @return DestinationRateDto
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
     * Add tpDestinationRate
     *
     * @param \Ivoz\Cgr\Domain\Model\TpDestinationRate\TpDestinationRateInterface $tpDestinationRate
     *
     * @return DestinationRateTrait
     */
    public function addTpDestinationRate(\Ivoz\Cgr\Domain\Model\TpDestinationRate\TpDestinationRateInterface $tpDestinationRate)
    {
        $this->tpDestinationRates->add($tpDestinationRate);

        return $this;
    }

    /**
     * Remove tpDestinationRate
     *
     * @param \Ivoz\Cgr\Domain\Model\TpDestinationRate\TpDestinationRateInterface $tpDestinationRate
     */
    public function removeTpDestinationRate(\Ivoz\Cgr\Domain\Model\TpDestinationRate\TpDestinationRateInterface $tpDestinationRate)
    {
        $this->tpDestinationRates->removeElement($tpDestinationRate);
    }

    /**
     * Replace tpDestinationRates
     *
     * @param \Ivoz\Cgr\Domain\Model\TpDestinationRate\TpDestinationRateInterface[] $tpDestinationRates
     * @return self
     */
    public function replaceTpDestinationRates(Collection $tpDestinationRates)
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($tpDestinationRates as $entity) {
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setDestinationRate($this);
        }
        $updatedEntityKeys = array_keys($updatedEntities);

        foreach ($this->tpDestinationRates as $key => $entity) {
            $identity = $entity->getId();
            if (in_array($identity, $updatedEntityKeys)) {
                $this->tpDestinationRates->set($key, $updatedEntities[$identity]);
            } else {
                $this->tpDestinationRates->remove($key);
            }
            unset($updatedEntities[$identity]);
        }

        foreach ($updatedEntities as $entity) {
            $this->addTpDestinationRate($entity);
        }

        return $this;
    }

    /**
     * Get tpDestinationRates
     *
     * @return \Ivoz\Cgr\Domain\Model\TpDestinationRate\TpDestinationRateInterface[]
     */
    public function getTpDestinationRates(Criteria $criteria = null)
    {
        if (!is_null($criteria)) {
            return $this->tpDestinationRates->matching($criteria)->toArray();
        }

        return $this->tpDestinationRates->toArray();
    }


}

