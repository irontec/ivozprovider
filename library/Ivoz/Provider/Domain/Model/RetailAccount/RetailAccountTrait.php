<?php

namespace Ivoz\Provider\Domain\Model\RetailAccount;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;

/**
 * RetailAccountTrait
 * @codeCoverageIgnore
 */
trait RetailAccountTrait
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var Collection
     */
    protected $psEndpoints;

    /**
     * @var Collection
     */
    protected $Ddis;


    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct(...func_get_args());
        $this->psEndpoints = new ArrayCollection();
        $this->Ddis = new ArrayCollection();
    }

    /**
     * @return RetailAccountDTO
     */
    public static function createDTO()
    {
        return new RetailAccountDTO();
    }

    /**
     * Factory method
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto RetailAccountDTO
         */
        $self = parent::fromDTO($dto);
        if ($dto->getPsEndpoints()) {
            $self->replacePsEndpoints($dto->getPsEndpoints());
        }

        if ($dto->getDdis()) {
            $self->replaceDdis($dto->getDdis());
        }
        if ($dto->getId()) {
            $self->id = $dto->getId();
        }
        $self->initChangelog();

        return $self;
    }

    /**
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public function updateFromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto RetailAccountDTO
         */
        parent::updateFromDTO($dto);
        if ($dto->getPsEndpoints()) {
            $this->replacePsEndpoints($dto->getPsEndpoints());
        }
        if ($dto->getDdis()) {
            $this->replaceDdis($dto->getDdis());
        }
        return $this;
    }

    /**
     * @return RetailAccountDTO
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
            'id' => $this->getId()
        ];
    }


    /**
     * Add psEndpoint
     *
     * @param \Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointInterface $psEndpoint
     *
     * @return RetailAccountTrait
     */
    public function addPsEndpoint(\Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointInterface $psEndpoint)
    {
        $this->psEndpoints->add($psEndpoint);

        return $this;
    }

    /**
     * Remove psEndpoint
     *
     * @param \Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointInterface $psEndpoint
     */
    public function removePsEndpoint(\Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointInterface $psEndpoint)
    {
        $this->psEndpoints->removeElement($psEndpoint);
    }

    /**
     * Replace psEndpoints
     *
     * @param \Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointInterface[] $psEndpoints
     * @return self
     */
    public function replacePsEndpoints(Collection $psEndpoints)
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($psEndpoints as $entity) {
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setRetailAccount($this);
        }
        $updatedEntityKeys = array_keys($updatedEntities);

        foreach ($this->psEndpoints as $key => $entity) {
            $identity = $entity->getId();
            if (in_array($identity, $updatedEntityKeys)) {
                $this->psEndpoints->set($key, $updatedEntities[$identity]);
            } else {
                $this->psEndpoints->remove($key);
            }
            unset($updatedEntities[$identity]);
        }

        foreach ($updatedEntities as $entity) {
            $this->addPsEndpoint($entity);
        }

        return $this;
    }

    /**
     * Get psEndpoints
     *
     * @return array
     */
    public function getPsEndpoints(Criteria $criteria = null)
    {
        if (!is_null($criteria)) {
            return $this->psEndpoints->matching($criteria)->toArray();
        }

        return $this->psEndpoints->toArray();
    }

    /**
     * Add ddi
     *
     * @param \Ivoz\Provider\Domain\Model\Ddi\DdiInterface $ddi
     *
     * @return RetailAccountTrait
     */
    public function addDdi(\Ivoz\Provider\Domain\Model\Ddi\DdiInterface $ddi)
    {
        $this->Ddis->add($ddi);

        return $this;
    }

    /**
     * Remove ddi
     *
     * @param \Ivoz\Provider\Domain\Model\Ddi\DdiInterface $ddi
     */
    public function removeDdi(\Ivoz\Provider\Domain\Model\Ddi\DdiInterface $ddi)
    {
        $this->Ddis->removeElement($ddi);
    }

    /**
     * Replace ddis
     *
     * @param \Ivoz\Provider\Domain\Model\Ddi\DdiInterface[] $ddis
     * @return self
     */
    public function replaceDdis(Collection $ddis)
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($ddis as $entity) {
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setRetailAccount($this);
        }
        $updatedEntityKeys = array_keys($updatedEntities);

        foreach ($this->Ddis as $key => $entity) {
            $identity = $entity->getId();
            if (in_array($identity, $updatedEntityKeys)) {
                $this->Ddis->set($key, $updatedEntities[$identity]);
            } else {
                $this->Ddis->remove($key);
            }
            unset($updatedEntities[$identity]);
        }

        foreach ($updatedEntities as $entity) {
            $this->addDdi($entity);
        }

        return $this;
    }

    /**
     * Get ddis
     *
     * @return array
     */
    public function getDdis(Criteria $criteria = null)
    {
        if (!is_null($criteria)) {
            return $this->Ddis->matching($criteria)->toArray();
        }

        return $this->Ddis->toArray();
    }


}

