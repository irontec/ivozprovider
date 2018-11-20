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
    protected $ddis;


    /**
     * Constructor
     */
    protected function __construct()
    {
        parent::__construct(...func_get_args());
        $this->ddis = new ArrayCollection();
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDto(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto RetailAccountDto
         */
        $self = parent::fromDto($dto);
        if ($dto->getDdis()) {
            $self->replaceDdis($dto->getDdis());
        }
        if ($dto->getId()) {
            $self->id = $dto->getId();
            $self->initChangelog();
        }

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public function updateFromDto(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto RetailAccountDto
         */
        parent::updateFromDto($dto);
        if ($dto->getDdis()) {
            $this->replaceDdis($dto->getDdis());
        }
        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return RetailAccountDto
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
     * Add ddi
     *
     * @param \Ivoz\Provider\Domain\Model\Ddi\DdiInterface $ddi
     *
     * @return RetailAccountTrait
     */
    public function addDdi(\Ivoz\Provider\Domain\Model\Ddi\DdiInterface $ddi)
    {
        $this->ddis->add($ddi);

        return $this;
    }

    /**
     * Remove ddi
     *
     * @param \Ivoz\Provider\Domain\Model\Ddi\DdiInterface $ddi
     */
    public function removeDdi(\Ivoz\Provider\Domain\Model\Ddi\DdiInterface $ddi)
    {
        $this->ddis->removeElement($ddi);
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

        foreach ($this->ddis as $key => $entity) {
            $identity = $entity->getId();
            if (in_array($identity, $updatedEntityKeys)) {
                $this->ddis->set($key, $updatedEntities[$identity]);
            } else {
                $this->ddis->remove($key);
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
     * @return \Ivoz\Provider\Domain\Model\Ddi\DdiInterface[]
     */
    public function getDdis(Criteria $criteria = null)
    {
        if (!is_null($criteria)) {
            return $this->ddis->matching($criteria)->toArray();
        }

        return $this->ddis->toArray();
    }
}
