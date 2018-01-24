<?php

namespace Ivoz\Cgr\Domain\Model\Rate;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;

/**
 * RateTrait
 * @codeCoverageIgnore
 */
trait RateTrait
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var Collection
     */
    protected $tpRates;


    /**
     * Constructor
     */
    protected function __construct()
    {
        parent::__construct(...func_get_args());
        $this->tpRates = new ArrayCollection();
    }

    /**
     * Factory method
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDto(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto RateDto
         */
        $self = parent::fromDto($dto);
        if ($dto->getTpRates()) {
            $self->replaceTpRates($dto->getTpRates());
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
         * @var $dto RateDto
         */
        parent::updateFromDto($dto);
        if ($dto->getTpRates()) {
            $this->replaceTpRates($dto->getTpRates());
        }
        return $this;
    }

    /**
     * @param int $depth
     * @return RateDto
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
     * Add tpRate
     *
     * @param \Ivoz\Cgr\Domain\Model\TpRate\TpRateInterface $tpRate
     *
     * @return RateTrait
     */
    public function addTpRate(\Ivoz\Cgr\Domain\Model\TpRate\TpRateInterface $tpRate)
    {
        $this->tpRates->add($tpRate);

        return $this;
    }

    /**
     * Remove tpRate
     *
     * @param \Ivoz\Cgr\Domain\Model\TpRate\TpRateInterface $tpRate
     */
    public function removeTpRate(\Ivoz\Cgr\Domain\Model\TpRate\TpRateInterface $tpRate)
    {
        $this->tpRates->removeElement($tpRate);
    }

    /**
     * Replace tpRates
     *
     * @param \Ivoz\Cgr\Domain\Model\TpRate\TpRateInterface[] $tpRates
     * @return self
     */
    public function replaceTpRates(Collection $tpRates)
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($tpRates as $entity) {
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setRate($this);
        }
        $updatedEntityKeys = array_keys($updatedEntities);

        foreach ($this->tpRates as $key => $entity) {
            $identity = $entity->getId();
            if (in_array($identity, $updatedEntityKeys)) {
                $this->tpRates->set($key, $updatedEntities[$identity]);
            } else {
                $this->tpRates->remove($key);
            }
            unset($updatedEntities[$identity]);
        }

        foreach ($updatedEntities as $entity) {
            $this->addTpRate($entity);
        }

        return $this;
    }

    /**
     * Get tpRates
     *
     * @return \Ivoz\Cgr\Domain\Model\TpRate\TpRateInterface[]
     */
    public function getTpRates(Criteria $criteria = null)
    {
        if (!is_null($criteria)) {
            return $this->tpRates->matching($criteria)->toArray();
        }

        return $this->tpRates->toArray();
    }


}

