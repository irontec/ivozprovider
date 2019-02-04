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
    protected function __construct()
    {
        parent::__construct(...func_get_args());
        $this->entries = new ArrayCollection();
        $this->excludedExtensions = new ArrayCollection();
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param DataTransferObjectInterface $dto
     * @param \Ivoz\Core\Application\ForeignKeyTransformerInterface  $fkTransformer
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        /**
         * @var $dto IvrDto
         */
        $self = parent::fromDto($dto, $fkTransformer);
        if (!is_null($dto->getEntries())) {
            $self->replaceEntries(
                $fkTransformer->transformCollection(
                    $dto->getEntries()
                )
            );
        }

        if (!is_null($dto->getExcludedExtensions())) {
            $self->replaceExcludedExtensions(
                $fkTransformer->transformCollection(
                    $dto->getExcludedExtensions()
                )
            );
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
     * @param \Ivoz\Core\Application\ForeignKeyTransformerInterface  $fkTransformer
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        /**
         * @var $dto IvrDto
         */
        parent::updateFromDto($dto, $fkTransformer);
        if (!is_null($dto->getEntries())) {
            $this->replaceEntries(
                $fkTransformer->transformCollection(
                    $dto->getEntries()
                )
            );
        }
        if (!is_null($dto->getExcludedExtensions())) {
            $this->replaceExcludedExtensions(
                $fkTransformer->transformCollection(
                    $dto->getExcludedExtensions()
                )
            );
        }
        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return IvrDto
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
     * @return \Ivoz\Provider\Domain\Model\IvrEntry\IvrEntryInterface[]
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
     * @return \Ivoz\Provider\Domain\Model\IvrExcludedExtension\IvrExcludedExtensionInterface[]
     */
    public function getExcludedExtensions(Criteria $criteria = null)
    {
        if (!is_null($criteria)) {
            return $this->excludedExtensions->matching($criteria)->toArray();
        }

        return $this->excludedExtensions->toArray();
    }
}
