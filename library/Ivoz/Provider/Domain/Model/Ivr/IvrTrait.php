<?php
declare(strict_types = 1);

namespace Ivoz\Provider\Domain\Model\Ivr;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\IvrEntry\IvrEntryInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Ivoz\Provider\Domain\Model\IvrExcludedExtension\IvrExcludedExtensionInterface;

/**
* @codeCoverageIgnore
*/
trait IvrTrait
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var ArrayCollection
     * IvrEntryInterface mappedBy ivr
     */
    protected $entries;

    /**
     * @var ArrayCollection
     * IvrExcludedExtensionInterface mappedBy ivr
     * orphanRemoval
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

    abstract protected function sanitizeValues();

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param IvrDto $dto
     * @param ForeignKeyTransformerInterface  $fkTransformer
     * @return static
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        /** @var static $self */
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

        $self->sanitizeValues();
        if ($dto->getId()) {
            $self->id = $dto->getId();
            $self->initChangelog();
        }

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param IvrDto $dto
     * @param ForeignKeyTransformerInterface  $fkTransformer
     * @return static
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
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
        $this->sanitizeValues();

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

    public function addEntry(IvrEntryInterface $entry): IvrInterface
    {
        $this->entries->add($entry);

        return $this;
    }

    public function removeEntry(IvrEntryInterface $entry): IvrInterface
    {
        $this->entries->removeElement($entry);

        return $this;
    }

    public function replaceEntries(ArrayCollection $entries): IvrInterface
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

    public function getEntries(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->entries->matching($criteria)->toArray();
        }

        return $this->entries->toArray();
    }

    public function addExcludedExtension(IvrExcludedExtensionInterface $excludedExtension): IvrInterface
    {
        $this->excludedExtensions->add($excludedExtension);

        return $this;
    }

    public function removeExcludedExtension(IvrExcludedExtensionInterface $excludedExtension): IvrInterface
    {
        $this->excludedExtensions->removeElement($excludedExtension);

        return $this;
    }

    public function replaceExcludedExtensions(ArrayCollection $excludedExtensions): IvrInterface
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

    public function getExcludedExtensions(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->excludedExtensions->matching($criteria)->toArray();
        }

        return $this->excludedExtensions->toArray();
    }
}
