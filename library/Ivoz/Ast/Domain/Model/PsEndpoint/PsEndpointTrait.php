<?php

namespace Ivoz\Ast\Domain\Model\PsEndpoint;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;

/**
 * PsEndpointTrait
 * @codeCoverageIgnore
 */
trait PsEndpointTrait
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var Collection
     */
    protected $psAors;


    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct(...func_get_args());
        $this->psAors = new ArrayCollection();
    }

    /**
     * @return PsEndpointDTO
     */
    public static function createDTO()
    {
        return new PsEndpointDTO();
    }

    /**
     * Factory method
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto PsEndpointDTO
         */
        $self = parent::fromDTO($dto);
        if ($dto->getPsAors()) {
            $self->replacePsAors($dto->getPsAors());
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
         * @var $dto PsEndpointDTO
         */
        parent::updateFromDTO($dto);
        if ($dto->getPsAors()) {
            $this->replacePsAors($dto->getPsAors());
        }
        return $this;
    }

    /**
     * @return PsEndpointDTO
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
     * Add psAor
     *
     * @param \Ivoz\Ast\Domain\Model\PsAor\PsAorInterface $psAor
     *
     * @return PsEndpointTrait
     */
    public function addPsAor(\Ivoz\Ast\Domain\Model\PsAor\PsAorInterface $psAor)
    {
        $this->psAors->add($psAor);

        return $this;
    }

    /**
     * Remove psAor
     *
     * @param \Ivoz\Ast\Domain\Model\PsAor\PsAorInterface $psAor
     */
    public function removePsAor(\Ivoz\Ast\Domain\Model\PsAor\PsAorInterface $psAor)
    {
        $this->psAors->removeElement($psAor);
    }

    /**
     * Replace psAors
     *
     * @param \Ivoz\Ast\Domain\Model\PsAor\PsAorInterface[] $psAors
     * @return self
     */
    public function replacePsAors(Collection $psAors)
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($psAors as $entity) {
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setPsEndpoint($this);
        }
        $updatedEntityKeys = array_keys($updatedEntities);

        foreach ($this->psAors as $key => $entity) {
            $identity = $entity->getId();
            if (in_array($identity, $updatedEntityKeys)) {
                $this->psAors->set($key, $updatedEntities[$identity]);
            } else {
                $this->psAors->remove($key);
            }
            unset($updatedEntities[$identity]);
        }

        foreach ($updatedEntities as $entity) {
            $this->addPsAor($entity);
        }

        return $this;
    }

    /**
     * Get psAors
     *
     * @return array
     */
    public function getPsAors(Criteria $criteria = null)
    {
        if (!is_null($criteria)) {
            return $this->psAors->matching($criteria)->toArray();
        }

        return $this->psAors->toArray();
    }


}

