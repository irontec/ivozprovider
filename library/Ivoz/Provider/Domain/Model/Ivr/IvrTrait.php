<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\Ivr;

use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\ForeignKeyTransformerInterface;
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
        foreach ($entries as $entity) {
            $entity->setIvr($this);
        }

        $toStringCallable = fn(mixed $val): \Stringable|string => $val instanceof \Stringable ? $val : serialize($val);
        foreach ($this->entries as $key => $entity) {
            /**
             * @psalm-suppress MixedArgument
             */
            $currentValue = array_map(
                $toStringCallable,
                (function (): array {
                    return $this->__toArray(); /** @phpstan-ignore-line */
                })->call($entity)
            );

            $match = false;
            foreach ($entries as $newKey => $newEntity) {
                /**
                 * @psalm-suppress MixedArgument
                 */
                $newValue = array_map(
                    $toStringCallable,
                    (function (): array {
                        return $this->__toArray(); /** @phpstan-ignore-line */
                    })->call($newEntity)
                );

                $diff = array_diff_assoc(
                    $currentValue,
                    $newValue
                );
                unset($diff['id']);

                if (empty($diff)) {
                    unset($entries[$newKey]);
                    $match = true;
                    break;
                }
            }

            if (!$match) {
                $this->entries->remove($key);
            }
        }

        foreach ($entries as $entity) {
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
        foreach ($excludedExtensions as $entity) {
            $entity->setIvr($this);
        }

        $toStringCallable = fn(mixed $val): \Stringable|string => $val instanceof \Stringable ? $val : serialize($val);
        foreach ($this->excludedExtensions as $key => $entity) {
            /**
             * @psalm-suppress MixedArgument
             */
            $currentValue = array_map(
                $toStringCallable,
                (function (): array {
                    return $this->__toArray(); /** @phpstan-ignore-line */
                })->call($entity)
            );

            $match = false;
            foreach ($excludedExtensions as $newKey => $newEntity) {
                /**
                 * @psalm-suppress MixedArgument
                 */
                $newValue = array_map(
                    $toStringCallable,
                    (function (): array {
                        return $this->__toArray(); /** @phpstan-ignore-line */
                    })->call($newEntity)
                );

                $diff = array_diff_assoc(
                    $currentValue,
                    $newValue
                );
                unset($diff['id']);

                if (empty($diff)) {
                    unset($excludedExtensions[$newKey]);
                    $match = true;
                    break;
                }
            }

            if (!$match) {
                $this->excludedExtensions->remove($key);
            }
        }

        foreach ($excludedExtensions as $entity) {
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
