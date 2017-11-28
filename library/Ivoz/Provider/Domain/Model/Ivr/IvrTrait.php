<?php

namespace Ivoz\Provider\Domain\Model\Ivr;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;

/**
 * IvrTrait
 * @codeCoverageIgnore
 */
trait IvrTrait
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
     * @var Collection
     */
    protected $excludedExtensions;


    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct(...func_get_args());
        $this->entries = new ArrayCollection();
        $this->excludedExtensions = new ArrayCollection();
    }

    /**
     * @return IvrDTO
     */
    public static function createDTO()
    {
        return new IvrDTO();
    }

    /**
     * Factory method
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto IvrDTO
         */
        $self = parent::fromDTO($dto);
        if ($dto->getEntries()) {
            $self->replaceEntries($dto->getEntries());
        }

        if ($dto->getExcludedExtensions()) {
            $self->replaceExcludedExtensions($dto->getExcludedExtensions());
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
         * @var $dto IvrDTO
         */
        parent::updateFromDTO($dto);
        if ($dto->getEntries()) {
            $this->replaceEntries($dto->getEntries());
        }
        if ($dto->getExcludedExtensions()) {
            $this->replaceExcludedExtensions($dto->getExcludedExtensions());
        }
        return $this;
    }

    /**
     * @return IvrDTO
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
     * @param \Ivoz\Provider\Domain\Model\IvrEntry\IvrEntryInterface $entry
     *
     * @return IvrTrait
     */
    public function addEntry(\Ivoz\Provider\Domain\Model\IvrEntry\IvrEntryInterface $entry)
    {
        $this->entries->add($entry);

        return $this;
    }

    /**
     * Remove entry
     *
     * @param \Ivoz\Provider\Domain\Model\IvrEntry\IvrEntryInterface $entry
     */
    public function removeEntry(\Ivoz\Provider\Domain\Model\IvrEntry\IvrEntryInterface $entry)
    {
        $this->entries->removeElement($entry);
    }

    /**
     * Replace entries
     *
     * @param \Ivoz\Provider\Domain\Model\IvrEntry\IvrEntryInterface[] $entries
     * @return self
     */
    public function replaceEntries(Collection $entries)
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($entries as $entity) {
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setIvr($this);
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

    /**
     * Add excludedExtension
     *
     * @param \Ivoz\Provider\Domain\Model\IvrExcludedExtension\IvrExcludedExtensionInterface $excludedExtension
     *
     * @return IvrTrait
     */
    public function addExcludedExtension(\Ivoz\Provider\Domain\Model\IvrExcludedExtension\IvrExcludedExtensionInterface $excludedExtension)
    {
        $this->excludedExtensions->add($excludedExtension);

        return $this;
    }

    /**
     * Remove excludedExtension
     *
     * @param \Ivoz\Provider\Domain\Model\IvrExcludedExtension\IvrExcludedExtensionInterface $excludedExtension
     */
    public function removeExcludedExtension(\Ivoz\Provider\Domain\Model\IvrExcludedExtension\IvrExcludedExtensionInterface $excludedExtension)
    {
        $this->excludedExtensions->removeElement($excludedExtension);
    }

    /**
     * Replace excludedExtensions
     *
     * @param \Ivoz\Provider\Domain\Model\IvrExcludedExtension\IvrExcludedExtensionInterface[] $excludedExtensions
     * @return self
     */
    public function replaceExcludedExtensions(Collection $excludedExtensions)
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($excludedExtensions as $entity) {
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setIvr($this);
        }
        $updatedEntityKeys = array_keys($updatedEntities);

        foreach ($this->excludedExtensions as $key => $entity) {
            $identity = $entity->getId();
            if (in_array($identity, $updatedEntityKeys)) {
                $this->excludedExtensions->set($key, $updatedEntities[$identity]);
            } else {
                $this->excludedExtensions->remove($key);
            }
            unset($updatedEntities[$identity]);
        }

        foreach ($updatedEntities as $entity) {
            $this->addExcludedExtension($entity);
        }

        return $this;
    }

    /**
     * Get excludedExtensions
     *
     * @return array
     */
    public function getExcludedExtensions(Criteria $criteria = null)
    {
        if (!is_null($criteria)) {
            return $this->excludedExtensions->matching($criteria)->toArray();
        }

        return $this->excludedExtensions->toArray();
    }


}

