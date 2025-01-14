<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\ApplicationServerSet;

use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\ApplicationServerSetRelApplicationServer\ApplicationServerSetRelApplicationServerInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Selectable;
use Doctrine\Common\Collections\Criteria;

/**
* @codeCoverageIgnore
*/
trait ApplicationServerSetTrait
{
    /**
     * @var ?int
     */
    protected $id = null;

    /**
     * @var Collection<array-key, ApplicationServerSetRelApplicationServerInterface> & Selectable<array-key, ApplicationServerSetRelApplicationServerInterface>
     * ApplicationServerSetRelApplicationServerInterface mappedBy applicationServerSet
     * orphanRemoval
     */
    protected $relApplicationServers;

    /**
     * Constructor
     */
    protected function __construct()
    {
        parent::__construct(...func_get_args());
        $this->relApplicationServers = new ArrayCollection();
    }

    abstract protected function sanitizeValues(): void;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param ApplicationServerSetDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        /** @var static $self */
        $self = parent::fromDto($dto, $fkTransformer);
        $relApplicationServers = $dto->getRelApplicationServers();
        if (!is_null($relApplicationServers)) {

            /** @var Collection<array-key, ApplicationServerSetRelApplicationServerInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $relApplicationServers
            );
            $self->replaceRelApplicationServers($replacement);
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
     * @param ApplicationServerSetDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        parent::updateFromDto($dto, $fkTransformer);
        $relApplicationServers = $dto->getRelApplicationServers();
        if (!is_null($relApplicationServers)) {

            /** @var Collection<array-key, ApplicationServerSetRelApplicationServerInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $relApplicationServers
            );
            $this->replaceRelApplicationServers($replacement);
        }
        $this->sanitizeValues();

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): ApplicationServerSetDto
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

    public function addRelApplicationServer(ApplicationServerSetRelApplicationServerInterface $relApplicationServer): ApplicationServerSetInterface
    {
        $this->relApplicationServers->add($relApplicationServer);

        return $this;
    }

    public function removeRelApplicationServer(ApplicationServerSetRelApplicationServerInterface $relApplicationServer): ApplicationServerSetInterface
    {
        $this->relApplicationServers->removeElement($relApplicationServer);

        return $this;
    }

    /**
     * @param Collection<array-key, ApplicationServerSetRelApplicationServerInterface> $relApplicationServers
     */
    public function replaceRelApplicationServers(Collection $relApplicationServers): ApplicationServerSetInterface
    {
        foreach ($relApplicationServers as $entity) {
            $entity->setApplicationServerSet($this);
        }

        $toStringCallable = fn(mixed $val): \Stringable|string => $val instanceof \Stringable ? $val : serialize($val);
        foreach ($this->relApplicationServers as $key => $entity) {
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
            foreach ($relApplicationServers as $newKey => $newEntity) {
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
                    unset($relApplicationServers[$newKey]);
                    $match = true;
                    break;
                }
            }

            if (!$match) {
                $this->relApplicationServers->remove($key);
            }
        }

        foreach ($relApplicationServers as $entity) {
            $this->addRelApplicationServer($entity);
        }

        return $this;
    }

    /**
     * @return array<array-key, ApplicationServerSetRelApplicationServerInterface>
     */
    public function getRelApplicationServers(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->relApplicationServers->matching($criteria)->toArray();
        }

        return $this->relApplicationServers->toArray();
    }
}
