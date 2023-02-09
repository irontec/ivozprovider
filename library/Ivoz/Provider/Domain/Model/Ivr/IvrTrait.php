<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\Ivr;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\IvrEntry\IvrEntryInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Selectable;
use Doctrine\Common\Collections\Criteria;
use Ivoz\Provider\Domain\Model\IvrExcludedExtension\IvrExcludedExtensionInterface;

/**
* @codeCoverageIgnore
*/
trait IvrTrait
{
    /**
     * @var ?int
     */
    protected $id = null;

    /**
     * @var Collection<array-key, IvrEntryInterface> & Selectable<array-key, IvrEntryInterface>
     * IvrEntryInterface mappedBy ivr
     */
    protected $entries;

    /**
     * @var Collection<array-key, IvrExcludedExtensionInterface> & Selectable<array-key, IvrExcludedExtensionInterface>
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

    abstract protected function sanitizeValues(): void;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param IvrDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        /** @var static $self */
        $self = parent::fromDto($dto, $fkTransformer);
        $entries = $dto->getEntries();
        if (!is_null($entries)) {

            /** @var Collection<array-key, IvrEntryInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $entries
            );
            $self->replaceEntries($replacement);
        }

        $excludedExtensions = $dto->getExcludedExtensions();
        if (!is_null($excludedExtensions)) {

            /** @var Collection<array-key, IvrExcludedExtensionInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $excludedExtensions
            );
            $self->replaceExcludedExtensions($replacement);
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
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        parent::updateFromDto($dto, $fkTransformer);
        $entries = $dto->getEntries();
        if (!is_null($entries)) {

            /** @var Collection<array-key, IvrEntryInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $entries
            );
            $this->replaceEntries($replacement);
        }

        $excludedExtensions = $dto->getExcludedExtensions();
        if (!is_null($excludedExtensions)) {

            /** @var Collection<array-key, IvrExcludedExtensionInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $excludedExtensions
            );
            $this->replaceExcludedExtensions($replacement);
        }
        $this->sanitizeValues();

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): IvrDto
    {
        $dto = parent::toDto($depth);
        return $dto
            ->setId($this->getId());
    }

    /**
     * @return array<string, mixed>
     */
    protected function __toArray(): array
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

    /**
     * @param Collection<array-key, IvrEntryInterface> $entries
     */
    public function replaceEntries(Collection $entries): IvrInterface
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($entries as $entity) {
            /** @var string|int $index */
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setIvr($this);
        }

        foreach ($this->entries as $key => $entity) {
            $identity = $entity->getId();
            if (!$identity) {
                $this->entries->remove($key);
                continue;
            }

            if (array_key_exists($identity, $updatedEntities)) {
                $this->entries->set($key, $updatedEntities[$identity]);
                unset($updatedEntities[$identity]);
            } else {
                $this->entries->remove($key);
            }
        }

        foreach ($updatedEntities as $entity) {
            $this->addEntry($entity);
        }

        return $this;
    }

    /**
     * @return array<array-key, IvrEntryInterface>
     */
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

    /**
     * @param Collection<array-key, IvrExcludedExtensionInterface> $excludedExtensions
     */
    public function replaceExcludedExtensions(Collection $excludedExtensions): IvrInterface
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($excludedExtensions as $entity) {
            /** @var string|int $index */
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setIvr($this);
        }

        foreach ($this->excludedExtensions as $key => $entity) {
            $identity = $entity->getId();
            if (!$identity) {
                $this->excludedExtensions->remove($key);
                continue;
            }

            if (array_key_exists($identity, $updatedEntities)) {
                $this->excludedExtensions->set($key, $updatedEntities[$identity]);
                unset($updatedEntities[$identity]);
            } else {
                $this->excludedExtensions->remove($key);
            }
        }

        foreach ($updatedEntities as $entity) {
            $this->addExcludedExtension($entity);
        }

        return $this;
    }

    /**
     * @return array<array-key, IvrExcludedExtensionInterface>
     */
    public function getExcludedExtensions(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->excludedExtensions->matching($criteria)->toArray();
        }

        return $this->excludedExtensions->toArray();
    }
}
