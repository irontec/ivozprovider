<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\Administrator;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\AdministratorRelPublicEntity\AdministratorRelPublicEntityInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Selectable;
use Doctrine\Common\Collections\Criteria;

/**
* @codeCoverageIgnore
*/
trait AdministratorTrait
{
    /**
     * @var ?int
     */
    protected $id = null;

    /**
     * @var Collection<array-key, AdministratorRelPublicEntityInterface> & Selectable<array-key, AdministratorRelPublicEntityInterface>
     * AdministratorRelPublicEntityInterface mappedBy administrator
     */
    protected $relPublicEntities;

    /**
     * Constructor
     */
    protected function __construct()
    {
        parent::__construct(...func_get_args());
        $this->relPublicEntities = new ArrayCollection();
    }

    abstract protected function sanitizeValues(): void;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param AdministratorDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        /** @var static $self */
        $self = parent::fromDto($dto, $fkTransformer);
        $relPublicEntities = $dto->getRelPublicEntities();
        if (!is_null($relPublicEntities)) {

            /** @var Collection<array-key, AdministratorRelPublicEntityInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $relPublicEntities
            );
            $self->replaceRelPublicEntities($replacement);
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
     * @param AdministratorDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        parent::updateFromDto($dto, $fkTransformer);
        $relPublicEntities = $dto->getRelPublicEntities();
        if (!is_null($relPublicEntities)) {

            /** @var Collection<array-key, AdministratorRelPublicEntityInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $relPublicEntities
            );
            $this->replaceRelPublicEntities($replacement);
        }
        $this->sanitizeValues();

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): AdministratorDto
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

    public function addRelPublicEntity(AdministratorRelPublicEntityInterface $relPublicEntity): AdministratorInterface
    {
        $this->relPublicEntities->add($relPublicEntity);

        return $this;
    }

    public function removeRelPublicEntity(AdministratorRelPublicEntityInterface $relPublicEntity): AdministratorInterface
    {
        $this->relPublicEntities->removeElement($relPublicEntity);

        return $this;
    }

    /**
     * @param Collection<array-key, AdministratorRelPublicEntityInterface> $relPublicEntities
     */
    public function replaceRelPublicEntities(Collection $relPublicEntities): AdministratorInterface
    {
        foreach ($relPublicEntities as $entity) {
            $entity->setAdministrator($this);
        }

        $toStringCallable = fn(mixed $val): \Stringable|string => $val instanceof \Stringable ? $val : serialize($val);
        foreach ($this->relPublicEntities as $key => $entity) {
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
            foreach ($relPublicEntities as $newKey => $newEntity) {
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
                    unset($relPublicEntities[$newKey]);
                    $match = true;
                    break;
                }
            }

            if (!$match) {
                $this->relPublicEntities->remove($key);
            }
        }

        foreach ($relPublicEntities as $entity) {
            $this->addRelPublicEntity($entity);
        }

        return $this;
    }

    /**
     * @return array<array-key, AdministratorRelPublicEntityInterface>
     */
    public function getRelPublicEntities(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->relPublicEntities->matching($criteria)->toArray();
        }

        return $this->relPublicEntities->toArray();
    }
}
