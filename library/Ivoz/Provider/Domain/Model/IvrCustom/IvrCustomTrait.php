<?php

namespace Ivoz\Provider\Domain\Model\IvrCustom;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;

/**
 * IvrCustomTrait
 * @codeCoverageIgnore
 */
trait IvrCustomTrait
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var Collection
     */
    protected $entries;


    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct(...func_get_args());
        $this->entries = new ArrayCollection();
    }

    /**
     * @return IvrCustomDTO
     */
    public static function createDTO()
    {
        return new IvrCustomDTO();
    }

    /**
     * Factory method
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto IvrCustomDTO
         */
        $self = parent::fromDTO($dto);
        if ($dto->getEntries()) {
            $self->replaceEntries($dto->getEntries());
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
         * @var $dto IvrCustomDTO
         */
        parent::updateFromDTO($dto);
        if ($dto->getEntries()) {
            $this->replaceEntries($dto->getEntries());
        }
        return $this;
    }

    /**
     * @return IvrCustomDTO
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
     * Add entry
     *
     * @param \Ivoz\Provider\Domain\Model\IvrCustomEntry\IvrCustomEntryInterface $entry
     *
     * @return IvrCustomTrait
     */
    public function addEntry(\Ivoz\Provider\Domain\Model\IvrCustomEntry\IvrCustomEntryInterface $entry)
    {
        $this->entries->add($entry);

        return $this;
    }

    /**
     * Remove entry
     *
     * @param \Ivoz\Provider\Domain\Model\IvrCustomEntry\IvrCustomEntryInterface $entry
     */
    public function removeEntry(\Ivoz\Provider\Domain\Model\IvrCustomEntry\IvrCustomEntryInterface $entry)
    {
        $this->entries->removeElement($entry);
    }

    /**
     * Replace entries
     *
     * @param \Ivoz\Provider\Domain\Model\IvrCustomEntry\IvrCustomEntryInterface[] $entries
     * @return self
     */
    public function replaceEntries(Collection $entries)
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($entries as $entity) {
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setIvrCustom($this);
        }
        $updatedEntityKeys = array_keys($updatedEntities);

        foreach ($this->entries as $key => $entity) {
            $identity = $entity->getId();
            if (in_array($identity, $updatedEntityKeys)) {
                $this->entries->set($key, $updatedEntities[$identity]);
            } else {
                $this->entries->remove($key);
            }
            unset($updatedEntities[$identity]);
        }

        foreach ($updatedEntities as $entity) {
            $this->addEntry($entity);
        }

        return $this;
    }

    /**
     * Get entries
     *
     * @return array
     */
    public function getEntries(Criteria $criteria = null)
    {
        if (!is_null($criteria)) {
            return $this->entries->matching($criteria)->toArray();
        }

        return $this->entries->toArray();
    }


}

